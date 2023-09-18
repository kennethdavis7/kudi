<?php

namespace App\Http\Controllers;

use App\Models\IngredientTypes;
use App\Models\IngredientVariants;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use App\Models\UserIngredients;
use Illuminate\Database\Eloquent\Collection;
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

        $condition = function ($query) use ($userAuth) {
            $query->where('current_qty', '>', 0)->where('user_id', $userAuth->id);
        };

        $ingredients = $user
            ->ingredientTypes()
            ->filter($search)
            ->whereHas('ingredientVariants', $condition)
            ->with([
                'ingredientVariants' => $condition,
            ])
            ->paginate(5);

        $units = Unit::orderBy('unit_category_id', 'asc')
            ->orderBy('value', 'asc')
            ->get()
            ->groupBy('unit_category_id');

        $ingredients->each(function($ingredient) use ($units) {
            $ingredient->ingredientVariants->map(function ($variant) use ($ingredient, $units) {
                $ingredientUnits = $units[$ingredient->unit_category_id];
                $result = $this->getDisplayQty($variant, $ingredientUnits);

                $variant['qty'] = $result['qty'];
                $variant['unit'] = $result['unit'];
            });
        });

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
        $request->validate([
            'decrease' => 'required',
            'unit_id' => 'required|exists:units,id',
        ]);

        $variant = IngredientVariants::find($id);

        $unit = Unit::find($request['unit_id']);
        $ingredientUnits = Unit::where('unit_category_id', '=', $variant->ingredientTypes->unit_category_id)->get();

        $newQty = $variant->current_qty - $request['decrease'] * $unit->value;

        $variant->current_qty = max(0, $newQty);
        $variant->save();

        $result = $this->getDisplayQty($variant, $ingredientUnits);

        $variant['qty'] = $result['qty'];
        $variant['unit'] = $result['unit'];

        return response()->json([
            "ingredient" => $variant,
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

        DB::transaction(function() use ($userId, $data) {
            $ingredientTypeId = $data['ingredient'];
            $qty = $data['qty'];
            $price = $data['price'];

            $unit = Unit::find($data["unit_id"]);
            $qtyValue = $qty * $unit->value;

            if (UserIngredients::where('user_id', '=', $userId)->where('ingredient_types_id', '=', $ingredientTypeId)->doesntExist()) {
                UserIngredients::create([
                    'user_id' => $userId,
                    'ingredient_types_id' => $ingredientTypeId,
                ]);
            }

            IngredientVariants::create([
                'user_id' => $userId,
                'ingredient_types_id' => $ingredientTypeId,
                'initial_qty' => $qtyValue,
                'current_qty' => $qtyValue,
                'buy_price' => $price,
            ]);
        });


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
    public function update(Request $request, IngredientVariants $variant)
    {
        $validator = Validator::make($request->all(), [
            'buy_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ], 400);
        }

        $data = $validator->validated();
        $variant['buy_price'] = $data['buy_price'];

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

    private function getDisplayQty(IngredientVariants $variant, Collection $units)
    {
        foreach ($units as $unit) {
            $qty = $variant->current_qty / $unit->value;
            $unit = $unit->abbreviation;

            if ($qty <= 1000) break;
        }

        return [
            'qty' => $qty,
            'unit' => $unit,
        ];
    }
}
