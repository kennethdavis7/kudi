<?php

use App\Http\Controllers\AddRecipeController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\Authenticates;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Models\FavoriteRecipes;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware("auth");
Route::get('/ingredients/creation-times', [IngredientController::class, 'fetchCreationTimes'])->middleware("auth");
Route::get('/ingredients/fetchData/{search}', [IngredientController::class, 'fetchData'])->middleware("auth");
Route::put('/ingredients/decrease/{id}', [IngredientController::class, 'decrease'])->middleware("auth");
Route::delete('/ingredients/deleteVariant/{ingredientVariant}', [IngredientController::class, 'deleteVariant'])->middleware("auth");
Route::get('/login', [LoginController::class, 'index'])->middleware("guest");
Route::post('/login', [LoginController::class, 'store'])->name("login");
Route::get('/logout', [LoginController::class, 'logout'])->middleware("auth");
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware("auth");
Route::get('/register', [RegisterController::class, 'index'])->middleware("guest");
Route::post('/register', [RegisterController::class, 'store'])->middleware("guest");
Route::get('/recipes/detail/{id}', [RecipeController::class, 'detail'])->middleware("auth");
Route::get('/recipes/fetchData/{search}', [RecipeController::class, 'fetchData'])->middleware("auth");
Route::get('/favorites/fetchData/{search}', [FavoriteController::class, 'fetchData'])->middleware("auth");
Route::get('/addRecipe', [AddRecipeController::class, 'index'])->middleware("auth");
Route::get('/ingredients/{id}/getUnit', [IngredientController::class, 'getUnit'])->middleware("auth");


Route::resource('/ingredients', IngredientController::class)->middleware("auth");
Route::resource('/recipes', RecipeController::class)->middleware("auth");
Route::resource('/favorites', FavoriteController::class)->middleware("auth");
