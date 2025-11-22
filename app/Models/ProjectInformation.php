<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInformation extends Model
{
    protected $table = 'project_informations';
    protected $fillable = [
        'project_id',
        'slug',
        'full_name',
        'email',
        'job',
        'age',
        'phone',
        'type',
        'acreage',
        'scale',
        'address',
        'a_cost_estimates',
        'number_people',
        'function_room_number',
        'b_cost_estimates',
        'function_description',
        'design_progress',
        'finishing_progress',
        'hobby_habit',
        'why_do_you_know'
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
