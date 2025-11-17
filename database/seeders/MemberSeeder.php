<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member; 
use Illuminate\Support\Facades\Schema;

class MemberSeeder extends Seeder
{

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Member::truncate();
        Schema::enableForeignKeyConstraints();
        // $membersData = [
        //     [
        //         'name' => 'Hoàng Nguyễn',
        //         'image' => 'VICNGUYEN.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Phạm Xuân Hà',
        //         'image' => 'PHAMXUANHA.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Nguyễn Nga',
        //         'image' => 'NGUYENNGA.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Nguyễn Hoàng',
        //         'image' => 'NGUYENHOANG.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Nguyễn Nga',
        //         'image' => 'NGUYENNGA.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Hoàng Nguyễn',
        //         'image' => 'VICNGUYEN.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Nguyễn Hoàng',
        //         'image' => 'NGUYENHOANG.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Phạm Xuân Hà',
        //         'image' => 'PHAMXUANHA.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Hưng Đào',
        //         'image' => 'PHAMXUANHA.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Ngọc Hoàng',
        //         'image' => 'VICNGUYEN.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        //     [
        //         'name' => 'Cường Vũ',
        //         'image' => 'NGUYENHOANG.png',
        //         'graduation_year' => '2015',
        //         'join_year' => '2023',
                
        //         'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
        //     ],
        // ];
        // foreach($membersData as $members){
        //     Member::create($members);
        // }
    }
}
