<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;

class PrintController extends Controller
{
    public function index(Recipe $recipe)
    {

        // $ingredients = Recipe::where('recipes.id', $recipe->id)->leftJoin('recipe_ingredients', 'recipe_ingredients.recipe_id', '=', 'recipes.id')
        //     ->leftJoin('ingredient_variants', 'ingredient_variants.ingredient_types_id', '=', 'recipe_ingredients.ingredient_types_id',)
        //     ->leftJoin('ingredient_types', 'ingredient_types.id', '=', 'ingredient_variants.ingredient_types_id')->get();

        $ingredients = RecipeIngredient::where('recipe_id', $recipe->id)
            ->leftJoin('ingredient_types', 'ingredient_types.id', '=', 'recipe_ingredients.ingredient_types_id')
            ->leftJoin('units', 'units.id', '=', 'recipe_ingredients.unit_id')
            ->leftJoin('unit_categories', 'unit_categories.id', '=', 'units.unit_category_id')
            ->get();

        $steps = RecipeStep::where('recipe_id', $recipe->id)->get();

        return view('dashboard.templates.print', [
            'title' => 'Print',
            'recipe' => $recipe,
            'ingredients' => $ingredients,
            'steps' => $steps
        ]);
    }
}
