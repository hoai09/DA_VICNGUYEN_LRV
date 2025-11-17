<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectImage extends Model
{
    use HasFactory;
    protected $table = 'project_images';
    protected $fillable=['project_id','image_path','caption'];


    public function project()
    {
    return $this->belongsTo(Project::class);
    }
}