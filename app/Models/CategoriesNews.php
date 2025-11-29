<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use Illuminate\Support\Str;

class CategoriesNews extends Model
{
    protected $table='categories_news';
    protected $fillable = [
        'name',
        'slug'
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    public static function generateUniqueSlug($title, $projectId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
        ->when($categoryId, function ($query) use ($projectId) {
            $query->where('id', '!=', $projectId);
        })
        ->exists())
        {
        $slug = $originalSlug . '-' . $counter++;
        }
        return $slug;
    }
    public function getRouteKeyName()
    {
    return 'slug';
    }
}
