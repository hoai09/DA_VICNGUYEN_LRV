<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $casts = [
        'published_at' => 'datetime',
    ];
    protected $fillable = [
        'category_id',
        'title',
        'summary',
        'content',
        'feature_image',
        'published_at'
    ];
    
    
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'projects_news', 'news_id', 'projects_id');
    }
}
