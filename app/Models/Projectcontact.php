<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projectcontact extends Model
{
    protected $table = 'project_contacts';
    protected $fillable = [
        'name','email','objects','content'
    ];
}
