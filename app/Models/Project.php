<?php

namespace App\Models;

use App\Models\MemberProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable=['title','slug','category','address','acreage','status','start_year','end_year','description','created_by'];

    public function images(){
        return $this->hasMany(ProjectImage::class);
    }
    
    public function members(){
        return $this->belongsToMany(Member::class,'member_project','project_id','member_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'project_news', 'project_id', 'news_id');
    }

    public function project_information()
    {
        return $this->hasMany(Information::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    

}
