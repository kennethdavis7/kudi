<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use \Mpdf\Mpdf as PDF;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


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

    public function document(Recipe $recipe)
    {
        $ingredients = RecipeIngredient::where('recipe_id', $recipe->id)
            ->leftJoin('ingredient_types', 'ingredient_types.id', '=', 'recipe_ingredients.ingredient_types_id')
            ->leftJoin('units', 'units.id', '=', 'recipe_ingredients.unit_id')
            ->leftJoin('unit_categories', 'unit_categories.id', '=', 'units.unit_category_id')
            ->get();

        $steps = RecipeStep::where('recipe_id', $recipe->id)->get();

        // Setup a filename 
        $documentFileName = "recipe.pdf";

        // Create the mPDF document
        $document = new PDF([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
        ]);

        $document->showImageErrors = true;

        // Set some header informations for output
        $document->setAutoTopMargin = 'stretch';
        $document->setAutoBottomMargin = 'stretch';
        $document->autoPageBreak = true;

        $img = asset('storage/' . $recipe->recipe_img);
        $html = "
        <div class='container'>
        <div class='row'>
            <h1 class='text-center my-4'>$recipe->recipe_name</h1>
            <hr>
            <div class='row content'>
                <img src='./$img' style='width: 100%; height: 300px; object-fit: cover;' class='w-100'>
                <div class='col-6 mt-4 left-column'>
                    <h4>Description</h4>
                    <p class='mt-2 text-justify' style='font-size: 10px;'>$recipe->description</p>
                    <i class='bi bi-clock'><span id='cook-time' style='font-size: 15px;'></span></i>
                    <hr>
                    <h4>Ingredients</h4>
                    <ul class='list-group list-group-flush'>
        ";

        // Write some simple Content
        $document->WriteHTML($html);

        // Save PDF on your public storage 
        $pdfContents = $document->Output('', 'S');
        Storage::disk('public')->put($documentFileName, $pdfContents);

        // Get file back from storage with the given header information
        return response()->make($pdfContents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $documentFileName . '"',
        ]);
    }
}
