<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('member_project')->truncate();

        DB::table('member_project')->insert([
            ['member_id' => 9, 'project_id' => 1, 'role' => 'Designer'],
            ['member_id' => 10, 'project_id' => 1, 'role' => 'Designer'],
            ['member_id' => 11, 'project_id' => 1, 'role' => 'Designer'],
        ]);
    }
}
