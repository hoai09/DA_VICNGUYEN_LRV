<?php

namespace App\Models;

use App\Models\MemberProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable=[
        'title',// tiêu đề
        'slug',
        'category',//thể loại
        'address',// địa chỉ
        'acreage',//diện tích
        'status',//trạng thái
        'start_year',//năm bắt đầu
        'end_year',//năm kết thúc
        'description',//mô tả
        'created_by'//người tạo
    ];

    public function images(){
        return $this->hasMany(ProjectImage::class);
    }
    
    public function members(){
        return $this->belongsToMany(Member::class,'member_project','project_id','member_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function project_information()
    {
        return $this->hasMany(Information::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    public static function generateUniqueSlug($title, $projectId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)
        ->when($projectId, function ($query) use ($projectId) {
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
