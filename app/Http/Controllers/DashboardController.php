<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientTypes;
use App\Models\IngredientVariants;
use App\Models\Month;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $thisYear = Carbon::now()->format('Y');

        $monthlyExpense = Month::select([
            DB::raw('COALESCE(SUM(ingredient_variants.buy_price * ingredient_variants.initial_qty), 0) expense'),
            'months.month',
        ])
            ->leftJoin('user_ingredients', function ($join) use ($userId) {
                $join->on('user_ingredients.user_id', '=', DB::raw("'$userId'"));
            })
            ->leftJoin('ingredient_variants', function ($join) use ($thisYear) {
                $join->on('ingredient_variants.ingredient_types_id', '=', 'user_ingredients.ingredient_types_id');
                $join->on('months.month', '=', DB::raw('MONTH(ingredient_variants.created_at)'));
                $join->on(DB::raw('YEAR(ingredient_variants.created_at)'), '=', DB::raw("'$thisYear'"));
            })

            ->groupBy(DB::raw('MONTH(ingredient_variants.created_at)'), 'months.month')
            ->orderBy('months.month', 'ASC')
            ->pluck('expense');

        $variantQuery = IngredientVariants::leftJoin('user_ingredients', function ($join) use ($userId) {
            $join->on('user_ingredients.user_id', '=', DB::raw("'$userId'"));
            $join->on('user_ingredients.ingredient_types_id', '=', 'ingredient_variants.ingredient_types_id');
        });

        $ingredientCount = $variantQuery->clone()->where('ingredient_variants.user_id', "=", $userId)->sum('current_qty');

        if ($ingredientCount > 0) {
            $longestDurationKept = $variantQuery->clone()->where("current_qty", ">", 0)
                ->min(DB::raw('TIMESTAMPDIFF(SECOND, NOW(), ingredient_variants.created_at)'));
        } else {
            $longestDurationKept = -1;
        }

        return view("dashboard.index", [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'monthlyExpense' => $monthlyExpense,
            'ingredientCount' => $ingredientCount,
            'longestDurationKept' => $longestDurationKept,
        ]);
    }
}
