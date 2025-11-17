<?php

namespace App\Models;

use App\Models\MemberProject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    
    protected $table = 'members';
    protected $fillable = [
        'name',
        'image',
        'graduation_year',
        'join_year',
        'awards',
        
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class,'member_project','member_id', 'project_id')
                    ->withPivot('role')
                    ->withTimestamps();
    }

}
