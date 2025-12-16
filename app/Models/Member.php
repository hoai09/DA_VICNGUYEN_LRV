<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'name',                 //tên
        'slug',
        'site',                 //site
        'image',                //ảnh
        'graduation_year',      //năm tốt nghiệp
        'join_year',            //năm trở thành vicer
        'awards',               // giải thưởng
        'main_role',            // chức vụ chính
    ];


    public static function generateUniqueSlug($name, $memberId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($memberId, function ($query) use ($memberId) {
                    $query->where('id', '!=', $memberId);
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

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'member_project', 'member_id', 'project_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }
}
