<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_name', 'recipe_img', 'user_id', 'procedure'];

    public function scopeFilter($query, $search)
    {
        $query->when($search != "all" ? $search : false, function ($query, $search) {
            return $query->where("recipe_name", "LIKE", "%" . $search . "%");
        });
    }

    public function ingredients()
    {
        return $this->belongstoMany(IngredientTypes::class, "recipe_ingredients");
    }
}
