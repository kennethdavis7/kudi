<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientTypes extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function scopeFilter($query, $search)
    {
        $query->when($search != "all" ? $search : false, function ($query, $search) {
            return $query->where("type", "LIKE", "%" . $search . "%");
        });
    }

    public function ingredientVariants()
    {
        return $this->hasMany(IngredientVariants::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, "user_ingredients");
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, "recipe_ingredients");
    }
}
