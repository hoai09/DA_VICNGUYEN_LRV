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
        'title',// tiêu đề
        'slug',
        'summary',//tóm tắt
        'content',//nội dung
        'feature_image',//ảnh
        'featured_news',//tin nổi bật
        'latest_news',//tin mới
        'published_at',//ngày đăng
        'is_published',// đăng ngay(trạng thái)
        'author_id',//người đăng
        'meta_title', 
        'meta_description',
        'view_count'//người xem
    ];


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




