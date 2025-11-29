<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactAdvice extends Model  
{
    protected $table = 'contact_advices';
    protected $fillable = [
        'project_id', // id
        'slug',//
        'full_name',// họ tên
        'email',// email
        'job',// nghề nghiệp
        'age',// tuổi
        'phone', //sđt
        'project_type',// loại dự án
        'area',//diện tích
        'project_scale',//quy mô
        'address',// địa điểm
        'a_invest',// số người chi phí đầu tư
        'number_people',//số người sinh hoạt
        'func_room_count',// phòng chức năng mong muốn 
        'b_other_cost',// công trình khác
        'description',// mô tả 
        'design_timeline',// tiến độ mong muốn thiết kế
        'finish_date', // tiến dộ mong muốn hoàn thiện
        'hobbies',// sở thích
        'referral'//vì sao?
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
