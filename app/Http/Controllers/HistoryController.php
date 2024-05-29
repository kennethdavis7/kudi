<?php

namespace App\Http\Controllers;

use App\Models\RecipeUserHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function index()
    {
        return view('dashboard.history', [
            'title' => "History",
            'active' => "history",
        ]);
    }

    public function fetchData($filter = 'all')
    {
        $userId = auth()->user()->id;
        $recipes = User::find($userId)->recipeHistories()->when($filter != 'all', function ($recipe) use ($filter) {
            switch ($filter) {
                case 'day': {
                        return $recipe->where('recipe_user_history.created_at', '>=', Carbon::now()->tz('Asia/Jakarta')->subDay());
                    }
                case 'days': {
                        return $recipe->where('recipe_user_history.created_at', '>=', Carbon::now()->tz('Asia/Jakarta')->subDays(3));
                    }
                case 'week': {
                        return $recipe->where('recipe_user_history.created_at', '>=', Carbon::now()->tz('Asia/Jakarta')->subWeek());
                    }
                case 'month': {
                        return $recipe->where('recipe_user_history.created_at', '>=', Carbon::now()->tz('Asia/Jakarta')->subMonth());
                    }
                case 'year': {
                        return $recipe->where('recipe_user_history.created_at', '>=', Carbon::now()->tz('Asia/Jakarta')->subyear());
                    }
                default: {
                        return true;
                    }
            }
        })->paginate(10);

        return response()->json([
            'title' => "Recipe",
            'active' => "recipe",
            'recipes' => $recipes,
        ], 200);
    }

    public function updateHistory(Request $request, $history)
    {
        $history = RecipeUserHistory::find($history);

        $rating = $request->rating == '' ? null : $request->rating;
        $comment = $request->comment == '' ? null : $request->comment;

        $history->rating = $rating;
        $history->comment = $comment;

        $history->update();

        return response()->json([
            'message' => 'History has been updated',
        ]);
    }
}
