<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectContact extends Model          //model ni là của site design em xử lí form bữa trước ạ k phải của cái ui ni
{
    protected $table = 'project_contacts'; 
    protected $fillable = [
        'name','email','objects','content'
    ];
}
