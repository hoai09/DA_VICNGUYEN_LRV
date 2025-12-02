<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CompanyInfo extends Model
{
    protected $table = 'company_info_tables';

    protected $fillable = [
        'type',             //loại (studio/contact/social)
        'address',          // địa chỉ
        'email',            // email
        'phone',            //sđt
        'map_image',        //ảnh
        'slug',
        'social_links',     //link social
        'studio_image',     // ảnh studio
        'studio_content',   // nội dung studio
        'awards'            // danh sách giải thưởng
    ];

    protected $casts = [
        'social_links' => 'array',
        'awards'=>'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public static function generateUniqueSlug($title, $contactId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($contactId, function ($query) use ($contactId) {
                    $query->where('id', '!=', $contactId);
                })
                ->exists()
        ){
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
