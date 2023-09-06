<?php

namespace App\Http\Controllers;

use App\Models\FavoriteRecipes;
use App\Models\IngredientVariants;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\IngredientTypes;
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


        $recipes = RecipeIngredient::select(
            'recipes.id',
            'recipes.recipe_name',
            'recipes.description',
            'recipes.recipe_img',
            DB::raw('SUM(GREATEST(
                0, (recipe_ingredients.qty * units.value) - COALESCE(iv.total_current_qty, 0))
            ) missing_quantity'),
            DB::raw('IF(favorite_recipes.id IS NULL, 0, 1) AS is_favourited')
        )
            ->leftJoin('recipes', 'recipes.id', '=', 'recipe_ingredients.recipe_id')
            ->leftJoin(
                DB::raw("
                (SELECT
                    ingredient_variants.ingredient_types_id,
                    SUM(current_qty * units.value) AS total_current_qty
                FROM
                    ingredient_variants
                LEFT JOIN
                    units ON units.id = ingredient_variants.unit_id
                WHERE
                    user_id=$userId
                GROUP BY
                    ingredient_types_id
                ) AS iv"),
                'iv.ingredient_types_id',
                '=',
                'recipe_ingredients.ingredient_types_id'
            )
            ->leftJoin('units', 'units.id', '=', 'recipe_ingredients.unit_id')
            ->leftJoin('favorite_recipes', function ($join) use ($userId) {
                $join->on('favorite_recipes.recipe_id', '=', 'recipes.id');
                $join->on('favorite_recipes.user_id', '=', DB::raw("'$userId'"));
            })
            ->groupBy('recipes.id', 'recipes.recipe_name', 'recipes.description', 'recipe_img', 'favorite_recipes.id')
            ->orderBy('missing_quantity', 'asc')
            ->orderBy('recipes.recipe_name', 'asc');

        if ($search != "all") {
            $recipes = $recipes->where("recipe_name", "LIKE", "%" . $search . "%");
        }

        $recipes = $recipes->paginate(10);

        return response()->json([
            'title' => "Recipe",
            'active' => "recipe",
            'recipes' => $recipes,
        ], 200);
    }

    public function detail($id)
    {
        $recipe = Recipe::find($id);
        $userId = auth()->user()->id;

        $ingredients = RecipeIngredient::select(
            'ingredient_types.type',
            'recipe_ingredients.qty',
            'units.abbreviation AS unit',
            'recipes.recipe_img',
            DB::raw('GREATEST(
                0, (
                    recipe_ingredients.qty - (CAST(COALESCE(iv.total_current_qty, 0) AS DECIMAL(12, 2)) / CAST(units.value AS DECIMAL(12, 2)))
                )
            ) missing_quantity'),
        )
            ->leftJoin('recipes', 'recipes.id', '=', 'recipe_ingredients.recipe_id')
            ->leftJoin('user_ingredients', 'user_ingredients.ingredient_types_id', '=', 'recipe_ingredients.ingredient_types_id')
            ->leftJoin('ingredient_types', 'ingredient_types.id', '=', 'recipe_ingredients.ingredient_types_id')
            ->leftJoin(
                DB::raw("(
                SELECT
                    ingredient_types_id,
                    SUM(current_qty * units.value) AS total_current_qty
                FROM
                    ingredient_variants
                LEFT JOIN
                    units ON units.id = ingredient_variants.unit_id
                WHERE
                    user_id=$userId
                GROUP BY
                    ingredient_types_id
                ) AS iv"),
                function ($join) {
                    $join->on('ingredient_types.id', '=', 'iv.ingredient_types_id');
                }
            )
            ->leftJoin('units', 'units.id', '=', 'recipe_ingredients.unit_id')
            ->groupBy('ingredient_types.type', 'recipe_ingredients.qty', 'recipes.recipe_img', 'units.value', 'units.abbreviation', 'iv.total_current_qty')
            ->where('recipes.id', '=', $id)
            ->get();

        return view('dashboard.recipeDetail', [
            'title' => "Detail",
            'active' => "recipe",
            'recipe' => $recipe,
            'ingredients' => $ingredients,
        ]);
    }

    public function decreaseIngredientsByRecipe($id)
    {
        $userId = auth()->user()->id;

        $recipeIngredients = RecipeIngredient::select('qty', 'ingredient_types_id', 'units.value')
            ->where('recipe_id', $id)
            ->leftJoin('units', 'units.id', '=', 'recipe_ingredients.unit_id')
            ->get();

        $variants = IngredientVariants::select('ingredient_variants.*', 'units.value')
            ->where('user_id', $userId)
            ->leftJoin('units', 'units.id', '=', 'ingredient_variants.unit_id')
            ->orderBy('ingredient_types_id', 'desc')
            ->get();

        $recipeIngredients = $recipeIngredients->map(function ($value) {
            $value->qty *= $value->value;
            return $value;
        });

        foreach ($variants as $variant) {
            $ingredient = $recipeIngredients->first(function ($value) use ($variant) {
                return $value->ingredient_types_id === $variant->ingredient_types_id;
            });

            if ($ingredient === null) continue;

            $oldQuantity = $variant->current_qty * $variant->value;
            $newQuantity = max(0, $oldQuantity - $ingredient->qty);

            $variant->current_qty = $newQuantity / $variant->value;
            $ingredient->qty -= $oldQuantity - $newQuantity;

            $variant->save();
        }

        return view('dashboard.recipe', [
            'title' => "Recipe",
            'active' => "recipe",
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
