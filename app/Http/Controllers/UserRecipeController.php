<?php

namespace App\Http\Controllers;

use App\Models\IngredientTypes;
use Illuminate\Http\Request;
use App\Models\Recipe;

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
        // $validator = $request->validate([
        //     "recipe_img" => 'required|file',
        //     "recipe_name" => 'required',
        //     "description" => 'required',
        // ]);

        // for ($i = 0; $i < $request->ingredient; $i++) {
        //     $validator["ingredient"] = 
        //     $validator = $request->ingredient[$i]->validate([
        //         "ingredient" => 'required',
        //         "qty" => "required|integer",
        //         "unit" => "required"
        //     ]);
        // }

        // for ($j = 0; $j < $request->step; $j++) {
        //     $validator = $request->step[$i]->validate([
        //         "step" => 'required'
        //     ]);
        // }

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
