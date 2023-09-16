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
        return view('dashboard.userRecipe', [
            'title' => 'Your Recipe',
            'active' => 'user recipe',
        ]);
    }

    public function fetchData($search)
    {
        $recipes = Recipe::where('user_id', auth()->user()->id);

        if ($search != "all") {
            $recipes = $recipes->where("recipe_name", "LIKE", "%" . $search . "%");
        }

        $recipes = $recipes->paginate(5);
        return response()->json($recipes);
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
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg",
            "name" => "required",
            "description" => "required",
            "ingredients" => "required|array|min:1",
            "ingredients.*.type_id" => "required|distinct|exists:ingredient_types,id",
            "ingredients.*.unit_id" => "required|exists:units,id",
            "ingredients.*.qty" => "required|numeric|integer|min:1",
            "steps" => "required|array|min:1",
            "steps.*" => "required",
        ]);

        $imagePath = $request->image->store("public/images/recipes");

        $cookTime = ($request->hour * 3600) + ($request->minute * 60) + $request->second;

        $userId = auth()->user()->id;

        DB::transaction(function () use ($request, $imagePath, $userId, $cookTime) {
            $recipe = Recipe::create([
                "recipe_name" => $request->name,
                "description" => $request->description,
                "recipe_img" => $imagePath,
                "user_id" => $userId,
                "status" => (int) $request->status,
                "cook_time" => (int) $cookTime
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
        $recipes = Recipe::find($id);
        $steps = RecipeStep::where('recipe_id', $id)->get();
        $ingredients = RecipeIngredient::where('recipe_id', $id)->get();
        $ingredientTypes = IngredientTypes::get();

        return view('dashboard.userRecipeForms.editForm', [
            'title' => 'Your Recipe',
            'active' => 'user recipe',
            'recipes' => $recipes,
            'types' => $ingredientTypes,
            'steps' => $steps,
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $recipeId)
    {
        $request->validate([
            "image" => "image|mimes:jpeg,png,jpg,gif,svg",
            "name" => "required",
            "description" => "required",
            "ingredients" => "required|array|min:1",
            "ingredients.*.type_id" => "required|distinct|exists:ingredient_types,id",
            "ingredients.*.unit_id" => "required|exists:units,id",
            "ingredients.*.qty" => "required|numeric|integer|min:1",
            "steps" => "required|array|min:1",
            "steps.*" => "required"
        ]);

        $recipeObj = Recipe::find($recipeId);

        if ($request->image === null) {
            $imagePath = $recipeObj->recipe_img;
        } else {
            $imagePath = $request->image->store("public/images/recipes");
        }

        $userId = auth()->user()->id;

        $cookTime = ($request->hour * 3600) + ($request->minute * 60) + $request->second;

        $recipe = Recipe::where('id', $recipeId)
            ->where('user_id', $userId)
            ->first();

        if (!$recipe) return response('', 404);

        DB::transaction(function () use ($request, $imagePath, $userId, $recipeId, $recipe, $cookTime) {
            $recipe->update([
                "recipe_name" => $request->name,
                "description" => $request->description,
                "recipe_img" => $imagePath,
                "user_id" => $userId,
                "status" => (int) $request->status,
                "cook_time" => (int) $cookTime
            ]);

            RecipeIngredient::where('recipe_id', $recipeId)->delete();

            foreach ($request->ingredients as $ingredient) {
                RecipeIngredient::create([
                    "recipe_id" => $recipe->id,
                    "ingredient_types_id" => $ingredient["type_id"],
                    "qty" => $ingredient["qty"],
                    "unit_id" => $ingredient["unit_id"],
                ]);
            }

            RecipeStep::where('recipe_id', $recipeId)->delete();

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

    public function changeStatus(Request $request)
    {
        $request->validate([
            "id" => "required|exists:recipes,id",
            "status" => "required|integer|numeric",
        ]);

        $recipeId = $request->id;
        $status = $request->status;

        if ($status != 1) {
            Recipe::where('id', $recipeId)->update([
                'status' => 1
            ]);
        } else {
            Recipe::where('id', $recipeId)->update([
                'status' => 0
            ]);
        }

        return response('', 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Recipe::destroy($id);
        return response()->json([
            "message" => "Recipe has been deleted"
        ], 200);
    }
}
