<?php

namespace App\Http\Controllers;

use App\Models\IngredientTypes;
use App\Models\IngredientVariants;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use App\Models\UserIngredients;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredientTypes = IngredientTypes::latest()->get();

        return view("dashboard.ingredient", [
            "title" => "KuDi",
            "active" => "ingredient",
            "ingredientTypes" => $ingredientTypes,
        ]);
    }

    public function getUnit($id)
    {
        $unitCategoryId = IngredientTypes::find($id)->unit_category_id;
        $units = Unit::where('unit_category_id', '=', $unitCategoryId)->get();

        return response()->json([
            'units' => $units
        ], 200);
    }

    public function fetchData(Request $request, $search)
    {
        $userAuth = auth()->user();
        $user = User::where('name', '=', $userAuth->name)->first();

        if ($request->has('data')) {
            $ingredients = $user->ingredientTypes()->filter($request->data);
        } else {
            $ingredients = $user->ingredientTypes()->filter($search);
        }

        $condition = function ($query) use ($userAuth) {
            $query->where('current_qty', '>', 0)->where('user_id', $userAuth->id);
        };

        $ingredients = $ingredients->whereHas('ingredientVariants', $condition)->with([
            'ingredientVariants' => $condition,
            'ingredientVariants.unit',
        ])->paginate(5);

        return response()->json([
            "ingredients" => $ingredients,
            "title" => "KuDi",
            "active" => "ingredient"
        ]);
    }

    public function fetchCreationTimes()
    {
        $userId = auth()->user()->id;

        $variants = IngredientVariants::leftJoin('user_ingredients', function ($join) use ($userId) {
            $join->on('user_ingredients.user_id', '=', DB::raw("'$userId'"));
            $join->on('user_ingredients.ingredient_types_id', '=', 'ingredient_variants.ingredient_types_id');
        })->select('ingredient_variants.created_at', 'ingredient_variants.id')->get();

        return response()->json([
            "ingredient_variants" => $variants,
        ]);
    }

    public function decrease(int $id, Request $request)
    {
        $ingredient = IngredientVariants::find($id);
        $validator = Validator::make($request->all(), [
            'decrease' => 'required'
        ]);

        $qtyDecrease =  $validator->validated();

        $ingredient->current_qty = max(0, $ingredient->current_qty - $qtyDecrease['decrease']);
        $ingredient->save();

        return response()->json([
            "ingredient" => $ingredient,
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
        $validator = Validator::make($request->all(), [
            "price" => "required|numeric|min:0",
            "qty" => "required|numeric|min:1",
            "ingredient" => "required|exists:ingredient_types,id",
            "unit_id" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ], 400);
        }

        $userId = auth()->user()->id;
        $data = $validator->validated();

        $ingredientTypeId = $data['ingredient'];
        $unit = $data["unit_id"];
        $qty = $data['qty'];
        $price = $data['price'];

        if (UserIngredients::where('user_id', '=', $userId)->where('ingredient_types_id', '=', $ingredientTypeId)->doesntExist()) {
            UserIngredients::create([
                'user_id' => $userId,
                'ingredient_types_id' => $ingredientTypeId,
            ]);
        }

        IngredientVariants::create([
            'user_id' => $userId,
            'ingredient_types_id' => $ingredientTypeId,
            'initial_qty' => $qty,
            'current_qty' => $qty,
            'buy_price' => $price,
            'unit_id' => $unit,
        ]);

        return response()->json([
            'success' => 'Ingredient has been added'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(IngredientVariants $ingredientVariants)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $variants = IngredientVariants::find($id);

        return response()->json([
            "variants" => $variants
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "buy_price" => "required",
        ]);

        $data = $validator->validated();
        $currentQty = $request->current_qty;
        $initialQtyObject = IngredientVariants::where("id", $request->ingredient_variants_id)->select("initial_qty")->first();

        if ($currentQty > $initialQtyObject->initial_qty) {
            $data["initial_qty"] = $currentQty;
        }

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ], 400);
        }

        IngredientVariants::where("id", $request->ingredient_variants_id)->update($data);

        return response()->json([
            "success" => "Ingredient has been edited",
            "data" => $data,
            "id" => $request->ingredient_variants_id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $userId = auth()->user()->id;
        UserIngredients::where("user_id", "=", $userId)->where("ingredient_types_id", "=", $id)->delete();
        IngredientVariants::where("user_id", "=", $userId)->where("ingredient_types_id", "=", $id)->delete();
        return response()->json([
            "message" => "Ingredient has been deleted"
        ]);
    }

    public function deleteVariant(IngredientVariants $ingredientVariant)
    {
        $userId = auth()->user()->id;
        UserIngredients::where("user_id", "=", $userId)->where("ingredient_types_id", "=", $ingredientVariant->ingredient_types_id)->delete();
        IngredientVariants::destroy($ingredientVariant->id);
        return response()->json([
            "message" => "Ingredient has been deleted"
        ], 200);
    }
}
