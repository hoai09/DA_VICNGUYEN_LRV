<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\ProjectImage;

class ProjectImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        ProjectImage::truncate();
        Schema::enableForeignKeyConstraints();
        $ProjectImageData1=
        [
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project1-1.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project1-2.png',
                'caption'    => 'Anh project02',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project1-3.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/proeject1-4.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project2-1.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project2-2.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/Project2-4.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project3-4.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project3-1.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project3-2.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project3-3.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project1-3.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project4-1.png',
                'caption'    => 'Anh project01',
            ],
            [
                'project_id' => 1,
                'image_path' => 'assets/img/page2/project4-2.png',
                'caption'    => 'Anh project01',
            ],
        ];
            foreach ($ProjectImageData1 as $image) {
                ProjectImage::create($image);
            }
    }
}
