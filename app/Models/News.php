<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class News extends Model
{
    protected $casts = [
        'published_at' => 'datetime',
        'featured_news' => 'boolean',
        'latest_news' => 'boolean',
        'is_published' => 'boolean',
    ];
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'summary',
        'content',
        'feature_image',
        'featured_news',
        'latest_news',
        'published_at',
        'is_published',
        'author_id',
        'meta_title',
        'meta_description',
        'view_count'
    ];
    
    
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_news', 'news_id', 'project_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public static function generateUniqueSlug($title, $newsId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
        ->when($newsId, function ($query) use ($newsId) {
            $query->where('id', '!=', $newsId);
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




