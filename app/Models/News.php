<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoriesNews;
use Illuminate\Support\Str;


class News extends Model
{
    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'latest_news' => 'boolean',
        'is_published' => 'boolean',
    ];
    protected $fillable = [
        'title',                // tiêu đề
        'slug',
        'description',          //tóm tắt
        'content',              //nội dung
        'image',                //ảnh
        'is_featured',          //tin nổi bật
        'published_at',         //ngày đăng
        'is_published',         // đăng ngay(trạng thái)
        'create_by',            //người đăng
        'meta_title',
        'meta_description',
        'view_count',            //người xem
        'category_id',
    ];

    public function categoriesNews(){
        return $this->belongsTo(CategoriesNews::class,'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'create_by');
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

    public function getImageUrlAttribute()
{
    return $this->image ? asset('storage/'.$this->image) : asset('images/default-news.jpg');
}

}




