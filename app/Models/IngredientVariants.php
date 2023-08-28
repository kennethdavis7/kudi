<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientVariants extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function scopeFilter($query, $search)
    {
        $query->when($search != "all" ? $search : false, function ($query, $search) {
            return $query->where("ingredient_variants", "LIKE", "%" . $search . "%");
        });
    }

    public function ingredientTypes()
    {
        return $this->belongsTo(IngredientTypes::class);
    }

    public function ingredientHistory()
    {
        return $this->hasMany(IngredientHistory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
