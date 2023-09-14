<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_name', 'recipe_img', 'user_id', 'description', 'status'];

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

    public function steps()
    {
        return $this->hasMany(RecipeStep::class);
    }

    public function userHistories()
    {
        return $this->belongsToMany(User::class, "recipe_user_history", "recipe_id", "user_id")->withPivot("id", "comment", "rating", "created_at")->withTimestamps()->orderByPivot('created_at', 'desc');;
    }

    protected static function booted()
    {
        static::deleting(function (Recipe $recipe) {
            $recipe->ingredients()->detach();
            $recipe->steps()->delete();
        });
    }
}
