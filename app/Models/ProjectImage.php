<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class ProjectImage extends Model // bảng chứa ảnh của trang project
{
    use HasFactory;
    protected $table = 'project_images';
    protected $fillable=[
    'project_id',
    'image_path',       // đường dẫn ảnh
    
    ];


    public function project()
    {
    return $this->belongsTo(Project::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

}