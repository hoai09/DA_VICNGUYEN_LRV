<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'image',
        'order',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public static function generateUniqueSlug($name, $categoryId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
        ->when($categoryId, function ($query) use ($categoryId) {
            $query->where('id', '!=', $categoryId);
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
