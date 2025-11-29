<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Illuminate\Support\Str;

class CategoriesProject extends Model
{
    protected $table = 'categories_project';

    protected $fillable =[
        'name',
        'slug'
    ];

    public function projects(){
        return $this->hasMany(Project::class, 'category_id');
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
