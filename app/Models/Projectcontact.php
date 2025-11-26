<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectContact extends Model          //model của sidevicnguyendesign
{
    protected $table = 'project_contacts'; 
    protected $fillable = [
        'name','email','objects','content'
    ];
}
