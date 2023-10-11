<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TagRecipe extends Model
{
    use HasFactory;
    protected $fillable = ['recipe_id', 'tag_category_id'];

    public function recipe()
    {
        return $this->belongsToMany(Recipe::class, "tag_recipes");
    }

    public function tags()
    {
        return $this->belongsToMany(TagCategory::class, "tag_recipes");
    }
}
