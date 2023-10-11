<?php

namespace App\Http\Controllers;

use App\Models\IngredientVariants;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\TagCategory;
use App\Models\RecipeUserHistory;
use App\Models\TagRecipe;
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
        $search = json_decode($search);

        $userId = auth()->user()->id;

        $recipes = RecipeIngredient::select(
            'recipes.id',
            'recipes.recipe_name',
            'recipes.description',
            'recipes.recipe_img',
            'recipes.cook_time',
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
                    SUM(current_qty) AS total_current_qty
                FROM
                    ingredient_variants
                WHERE
                    user_id = $userId
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
            ->leftJoin('tag_recipes', 'tag_recipes.recipe_id', '=', 'recipes.id')
            ->leftJoin('tag_categories', 'tag_categories.id', '=', 'tag_recipes.tag_category_id')
            ->groupBy('recipes.id', 'recipes.recipe_name', 'recipes.description', 'recipe_img', 'favorite_recipes.id', 'recipes.cook_time')
            ->orderBy('missing_quantity', 'asc')
            ->orderBy('recipes.recipe_name', 'asc')
            ->where('recipes.status', 1);

        if ($search->search != "all") {
            $recipes = $recipes->where("recipe_name", "LIKE", "%" . $search->search . "%");
        }

        if (!empty($search->tags)) {

            $recipes = $recipes->whereIn('tag_recipes.tag_category_id', $search->tags);
            $recipes = $recipes->having(DB::raw('COUNT(DISTINCT tag_recipes.tag_category_id)'), count($search->tags));
        }

        $recipes = $recipes->paginate(10);

        $tags = TagRecipe::leftJoin('tag_categories', 'tag_categories.id', '=', 'tag_recipes.tag_category_id')
            ->leftJoin('recipes', 'recipes.id', '=', 'tag_recipes.recipe_id')->get();

        return response()->json([
            'title' => "Recipe",
            'active' => "recipe",
            'recipes' => $recipes,
            'tags' => $tags
        ], 200);
    }

    public function detail($id)
    {
        $recipe = Recipe::with([
            'steps' => function ($query) {
                $query->orderBy('order', 'ASC');
            }
        ])->find($id);
        $userId = auth()->user()->id;

        $ingredients = RecipeIngredient::select(
            'ingredient_types.type',
            'recipe_ingredients.qty',
            'units.abbreviation AS unit',
            'recipes.recipe_img',
            'recipes.cook_time',
            DB::raw('GREATEST(
                0, (
                    recipe_ingredients.qty - (CAST(COALESCE(iv.total_current_qty, 0) AS DECIMAL(12, 2)) / CAST(units.value AS DECIMAL(12, 2)))
                )
            ) missing_quantity'),
        )
            ->leftJoin('recipes', 'recipes.id', '=', 'recipe_ingredients.recipe_id')
            ->leftJoin('ingredient_types', 'ingredient_types.id', '=', 'recipe_ingredients.ingredient_types_id')
            ->leftJoin(
                DB::raw("(
                SELECT
                    ingredient_types_id,
                    SUM(current_qty) AS total_current_qty
                FROM
                    ingredient_variants
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
            ->groupBy('ingredient_types.type', 'recipe_ingredients.qty', 'recipes.recipe_img', 'units.value', 'units.abbreviation', 'iv.total_current_qty', 'recipes.cook_time')
            ->where('recipes.id', '=', $id)
            ->get();

        $comments = RecipeUserHistory::leftJoin('users', 'users.id', '=', 'recipe_user_history.user_id')->where('recipe_id', $id)->get();

        return view('dashboard.recipeDetail', [
            'title' => "Detail",
            'active' => "recipe",
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'comments' => $comments
        ]);
    }

    public function decreaseIngredientsByRecipe($id)
    {
        $userId = auth()->user()->id;

        $recipeIngredients = RecipeIngredient::select('qty', 'ingredient_types_id', 'units.value')
            ->where('recipe_id', $id)
            ->leftJoin('units', 'units.id', '=', 'recipe_ingredients.unit_id')
            ->get();

        $variants = IngredientVariants::where('user_id', $userId)
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

            $oldQuantity = $variant->current_qty;
            $newQuantity = max(0, $oldQuantity - $ingredient->qty);

            $variant->current_qty = $newQuantity;
            $ingredient->qty -= $oldQuantity - $newQuantity;

            $variant->save();
        }

        // Add recipe to user history
        $recipe = Recipe::find($id);
        $recipe->userHistories()->attach($userId);

        return view('dashboard.recipe', [
            'title' => "Recipe",
            'active' => "recipe",
        ]);
    }

    public function getTags()
    {
        $tags = TagCategory::all();

        return response()->json([
            'tags' => $tags
        ], 200);
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
