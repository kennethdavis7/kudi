<?php

namespace App\Http\Controllers;

use App\Models\FavoriteRecipes;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.recipe', [
            'title' => "Recipe",
            'active' => "recipe",
        ]);
    }

    public function fetchData($search)
    {
        $userId = auth()->user()->id;

        $recipes = Recipe::select(
            'recipes.id',
            'recipes.recipe_name',
            'recipes.description',
            'recipes.recipe_img',
            DB::raw('COUNT(recipe_ingredients.id) - COUNT(user_ingredients.id) AS missing_ingredient_count'),
            DB::raw('SUM(GREATEST(0, (recipe_ingredients.qty - COALESCE(iv.total_current_qty, 0)))) AS missing_quantity'),
            DB::raw('IF(favorite_recipes.id IS NULL, 0, 1) AS is_favourited')
        )
            ->leftJoin('recipe_ingredients', 'recipe_ingredients.recipe_id', '=', 'recipes.id')
            ->leftJoin('user_ingredients', function ($join) {
                $join->on('user_ingredients.ingredient_types_id', '=', 'recipe_ingredients.ingredient_types_id')
                    ->where('user_ingredients.user_id', '=', auth()->user()->id);
            })
            ->leftJoin(DB::raw('(SELECT ingredient_types_id, SUM(current_qty) AS total_current_qty FROM ingredient_variants WHERE user_id = ' . auth()->user()->id . ' GROUP BY ingredient_types_id) AS iv'), function ($join) {
                $join->on('recipe_ingredients.ingredient_types_id', '=', 'iv.ingredient_types_id');
            })
            ->leftJoin('favorite_recipes', function ($join) use ($userId) {
                $join->on('favorite_recipes.recipe_id', '=', 'recipes.id');
                $join->on('favorite_recipes.user_id', '=', DB::raw("'$userId'"));
            })
            ->groupBy('recipes.id', 'recipes.recipe_name', 'recipes.description', 'recipe_img', 'favorite_recipes.id')
            ->orderBy('missing_quantity', 'asc')
            ->orderBy('missing_ingredient_count', 'asc')
            ->orderBy('recipes.recipe_name', 'asc');

        if ($search != "all") {
            $recipes = $recipes->where("recipe_name", "LIKE", "%" . $search . "%");
        }

        $recipes = $recipes->paginate(6);

        return response()->json([
            'title' => "Recipe",
            'active' => "recipe",
            'recipes' => $recipes,
        ], 200);
    }

    public function detail($id)
    {
        $recipe = Recipe::find($id);

        $ingredients = RecipeIngredient::select(
            'ingredient_types.type',
            'recipe_ingredients.qty',
            'recipes.recipe_img',
            DB::raw('GREATEST(0, (recipe_ingredients.qty - COALESCE(iv.total_current_qty, 0))) missing_quantity')
        )
            ->leftJoin('recipes', 'recipes.id', '=', 'recipe_ingredients.recipe_id')
            ->leftJoin('user_ingredients', 'user_ingredients.ingredient_types_id', '=', 'recipe_ingredients.ingredient_types_id')
            ->leftJoin('ingredient_types', 'ingredient_types.id', '=', 'recipe_ingredients.ingredient_types_id')
            ->leftJoin(DB::raw('(SELECT ingredient_types_id, SUM(current_qty) AS total_current_qty FROM ingredient_variants WHERE user_id =' . auth()->user()->id . ' GROUP BY ingredient_types_id) AS iv'), function ($join) {
                $join->on('ingredient_types.id', '=', 'iv.ingredient_types_id');
            })
            ->groupBy('ingredient_types.type', 'recipe_ingredients.qty', 'recipes.recipe_img', 'iv.total_current_qty')
            ->where('recipes.id', '=', $id)
            ->get();

        return view('dashboard.recipeDetail', [
            'title' => "Detail",
            'active' => "recipe",
            'recipe' => $recipe,
            'ingredients' => $ingredients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
