<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member; 

class MemberSeeder extends Seeder
{

    public function run(): void
    {
        Member::truncate();

        $membersData = [
            [
                'name' => 'Hoàng Nguyễn',
                'role' => 'CEO & Lead 3D Artist',
                'image' => 'VICNGUYEN.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Phạm Xuân Hà',
                'role' => '3D Artist Generalist',
                'image' => 'PHAMXUANHA.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Nguyễn Nga',
                'role' => '3D Artist Generalist',
                'image' => 'NGUYENNGA.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Nguyễn Hoàng',
                'role' => 'Animation Expert',
                'image' => 'NGUYENHOANG.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Nguyễn Nga',
                'role' => '3D Artist Generalist',
                'image' => 'NGUYENNGA.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Hoàng Nguyễn',
                'role' => 'CEO & Lead 3D Artist',
                'image' => 'VICNGUYEN.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Nguyễn Hoàng',
                'role' => 'Animation Expert',
                'image' => 'NGUYENHOANG.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Phạm Xuân Hà',
                'role' => '3D Artist Generalist',
                'image' => 'PHAMXUANHA.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Phạm Xuân Hà',
                'role' => '3D Artist Generalist',
                'image' => 'PHAMXUANHA.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Hoàng Nguyễn',
                'role' => 'CEO & Lead 3D Artist',
                'image' => 'VICNGUYEN.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
            [
                'name' => 'Nguyễn Hoàng',
                'role' => 'Animation Expert',
                'image' => 'NGUYENHOANG.png',
                'graduation_year' => '2015',
                'join_year' => '2023',
                'projects' => 'NGUYETHOUSE,PHD,DANANGVILA',
                'awards' => 'Giải Đồng - Giải Thưởng Kiến Trúc Quốc Gia 2024',
            ],
        ];
        Member::insert($membersData);
    }
}
