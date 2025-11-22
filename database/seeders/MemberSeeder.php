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
        
    }
}
