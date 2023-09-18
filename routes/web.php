<?php

use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserRecipeController;

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

Route::middleware(['guest'])->group(function() {
    Route::controller(LoginController::class)->group(function() {
        Route::get('/login', 'index');
        Route::post('/login', 'store')->name("login");
    });

    Route::controller(RegisterController::class)->group(function() {
        Route::get('/register', 'index');
        Route::post('/register', 'store');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::redirect('/', '/dashboard');

    Route::get('/logout', [LoginController::class, 'logout']);

    Route::resource('/ingredients', IngredientController::class);
    Route::resource('/user-recipes', UserRecipeController::class);
    Route::resource('/recipes', RecipeController::class);
    Route::resource('/histories', HistoryController::class)->except('show', 'create', 'store', 'edit', 'update', 'destroy');
    Route::resource('/favorites', FavoriteController::class);

    Route::controller(IngredientController::class)->group(function() {
        Route::get('/ingredients/creation-times', 'fetchCreationTimes');
        Route::get('/ingredients/fetchData/{search}', 'fetchData');
        Route::put('/ingredients/decrease/{id}', 'decrease');
        Route::delete('/ingredients/deleteVariant/{ingredientVariant}', 'deleteVariant');

        Route::get('/ingredients/{id}/getUnit', 'getUnit');
    });

    Route::controller(RecipeController::class)->group(function() {
        Route::get('/recipes/detail/{id}', 'detail');
        Route::get('/recipes/fetchData/{search}', 'fetchData');
        Route::put('/recipes/decrease-ingredients-by-recipe/{id}', 'decreaseIngredientsByRecipe');
    });

    Route::controller(HistoryController::class)->group(function() {
        Route::get('/histories/fetchData/{filter}', 'fetchData');
        Route::patch('/histories/addRatingExperience/{history}', 'updateHistory');
    });

    Route::controller(BudgetController::class)->group(function() {
        Route::get('/budget', 'get');
        Route::put('/budget', 'store');
        Route::get('/budget/percentage', 'getPercentageBudget');
    });

    Route::controller(FavoriteController::class)->group(function() {
        Route::get('/favorites/fetchData/{search}', 'fetchData');
    });
});
