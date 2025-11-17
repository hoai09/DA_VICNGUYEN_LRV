<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Project::truncate(); 
        Schema::enableForeignKeyConstraints();
        $projectData1=
        [
           [
            'title'=>'NGUYET HOUSE',
            'slug'=> Str::slug('NGUYET HOUSE'),
            'category'=>'Nhà ở',
            'address'=>'Đồng bằng-Thái Nguyên',
            'start_year'=>'2022',
            'acreage'=>'400m2',
            'status'=>'Hoàn Thành',
            
            'description'=>'Luu house là công trình nhà ở cho gia đình 3 thế hệ được xây dựng
            với diện tích khiêm tốn. Khách hàng của chúng tôi là một cán bộ về
            hưu với mong muốn ngôi nhà là nơi khang trang, tươm tất để chứa
            đựng những niềm vui sum vầy cùng con cháu khi về già. Khối chức
            năng sinh hoạt chung và đảm bảo số lượng phòng ngủ là những yêu
            cầu cơ bản. Chúng tôi tạo ra một giếng trời lớn ở giữa nhà và sử
            dụng giải pháp lệch tầng cho các khối chức năng rồi liên kết lại
            bằng các hệ cầu thang, trục giao thông hình thành và biến đổi tự
            nhiên theo hướng phát triển không gian chức năng. Một khoảng rỗng
            lớn được thiết lập để duy trì tính cân bằng cho không gian, giúp
            lưu thông không khí và điều tiết ánh sáng tự nhiên. Các phòng chức
            năng vẫn đảm bảo trang thái riêng tư và mở khi cần, gợi mở hơn về
            một không gian sẽ kết nối thật nhiều tình yêu',
           ]
        ];
        foreach ($projectData1 as $project) 
        {
        Project::create($project);
        }
    }
}