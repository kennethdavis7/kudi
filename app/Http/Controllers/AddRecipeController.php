<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddRecipeController extends Controller
{
    public function index()
    {
        return view('dashboard.addRecipe', [
            'title' => 'Add Recipe',
            'active' => 'addRecipe',
        ]);
    }
}
