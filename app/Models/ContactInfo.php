<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactInfo extends Model
{
    protected $table = 'contact_infos';

    protected $fillable = [
        'address',
        'email',
        'phone',
        'map_image',
        'slug'
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
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
