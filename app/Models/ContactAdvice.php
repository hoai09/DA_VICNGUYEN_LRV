<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactAdvice extends Model  
{
    protected $table = 'project_informations';
    protected $fillable = [
        'project_id', // id
        'slug',//
        'full_name',// họ tên
        'email',// email
        'job',// nghề nghiệp
        'age',// tuổi
        'phone', //sđt
        'type',// loại dự án
        'acreage',//diện tích
        'scale',//quy mô
        'address',// địa điểm
        'a_cost_estimates',// số người chi phí đầu tư
        'number_people',//số người sinh hoạt
        'function_room_number',// phòng chức năng mong muốn 
        'b_cost_estimates',// công trình khác
        'function_description',// mô tả 
        'design_progress',// tiến độ mong muốn thiết kế
        'finishing_progress', // tiến dộ mong muốn hoàn thiện
        'hobby_habit',// sở thích
        'why_do_you_know'//vì sao?
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
