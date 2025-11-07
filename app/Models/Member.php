<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    
    protected $table = 'members';
    protected $fillable = [
        'name',
        'role',
        'image',
        'graduation_year',
        'join_year',
        'projects',
        'awards',
    ];
}
