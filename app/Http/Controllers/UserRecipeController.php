<?php

namespace App\Http\Controllers;

use App\Models\IngredientTypes;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use Illuminate\Support\Facades\DB;

class UserRecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::where('user_id', auth()->user()->id)->get();
        return view('dashboard.userRecipe', [
            'title' => 'Your Recipe',
            'active' => 'user recipe',
            'recipes' => $recipes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredientTypes = IngredientTypes::get();
        return view('dashboard.userRecipeForms.addForm', [
            'title' => 'Your Recipe',
            'active' => 'user recipe',
            'types' => $ingredientTypes
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "name" => "required",
            "description" => "required",
            "ingredients" => "required|array|min:1",
            "ingredients.*.type_id" => "required|distinct|exists:ingredient_types,id",
            "ingredients.*.unit_id" => "required|exists:units,id",
            "ingredients.*.qty" => "required|numeric|integer|min:1",
            "steps" => "required|array|min:1",
            "steps.*" => "required",
        ]);

        $imagePath = $request->image->store("public/images");

        $userId = auth()->user()->id;

        DB::transaction(function() use ($request, $imagePath, $userId) {
            $recipe = Recipe::create([
                "recipe_name" => $request->name,
                "description" => $request->description,
                "recipe_img" => $imagePath,
                "user_id" => $userId,
            ]);

            foreach ($request->ingredients as $ingredient) {
                RecipeIngredient::create([
                    "recipe_id" => $recipe->id,
                    "ingredient_types_id" => $ingredient["type_id"],
                    "qty" => $ingredient["qty"],
                    "unit_id" => $ingredient["unit_id"],
                ]);
            }

            foreach ($request->steps as $index => $step) {
                RecipeStep::create([
                    "recipe_id" => $recipe->id,
                    "name" => $step,
                    "order" => $index + 1,
                ]);
            }
        });

        return response('', 204);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Recipe::destroy($id);
        return response()->json([
            "message" => "Ingredient has been deleted"
        ], 200);
    }
}
