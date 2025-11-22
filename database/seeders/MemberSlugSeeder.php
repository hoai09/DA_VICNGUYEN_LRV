<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Str;

class MemberSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = Member::all();
        $existingSlugs = [];

        foreach ($members as $member) {
            $baseSlug = Str::slug($member->name);
            $slug = $baseSlug;
            $i = 1;

            // Nếu trùng trong database hoặc trùng với slug đã tạo trong vòng lặp
            while (in_array($slug, $existingSlugs) || Member::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $i;
                $i++;
            }

            $member->slug = $slug;
            $member->save();

            $existingSlugs[] = $slug; // lưu vào mảng để kiểm tra trùng tiếp
        }
    }
}
