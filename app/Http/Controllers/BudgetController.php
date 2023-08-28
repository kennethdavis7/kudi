<?php

namespace App\Http\Controllers;

use App\Models\IngredientVariants;
use App\Models\MonthlyBudget;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'budget' => 'required|numeric|min:0',
        ]);

        $userId = auth()->user()->id;
        $budget = MonthlyBudget::where('user_id', '=', $userId)->first();

        if ($budget === null) {
            MonthlyBudget::create([
                'user_id' => $userId,
                'budget' => $validated['budget'],
            ]);
        } else {
            $budget->budget = $validated['budget'];
            $budget->save();
        }

        return response()->json();
    }

    public function getPercentageBudget()
    {
        $userId = auth()->user()->id;
        $thisMonth = Carbon::now()->month;
        $budgetModel = MonthlyBudget::where('user_id', $userId)->first();

        if ($budgetModel === null) {
            $budget = 0;
        } else {
            $budget = $budgetModel->budget;
        }

        $totalPrice = IngredientVariants::where('user_id', $userId)
            ->where(DB::raw('MONTH(created_at)'), $thisMonth)
            ->sum('buy_price');

        $percentage = ($totalPrice / $budget) * 100;

        if ($percentage > 100) {
            return response()->json([
                'percentage' => $percentage,
                'color' => 'bg-danger'
            ]);
        }
        return response()->json([
            'percentage' => $percentage,
            'color' => 'bg-success'
        ]);
    }

    public function get()
    {
        $userId = auth()->user()->id;
        $budget = MonthlyBudget::where('user_id', '=', $userId)->first();

        if ($budget === null) {
            return response()->json([
                'budget' => 0,
            ]);
        }

        return response()->json([
            'budget' => $budget['budget'],
        ]);
    }
}
