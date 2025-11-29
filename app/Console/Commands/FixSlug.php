<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CompanyInfo;
use Illuminate\Support\Str;

class FixSlug extends Command
{
    protected $signature = 'fix:slug';
    protected $description = 'Tạo slug cho toàn bộ contact_infos chưa có slug';

    public function handle()
    {
        $records = CompanyInfo::whereNull('slug')
                    ->orWhere('slug', '')
                    ->get();

        foreach ($records as $record) {
            $slug = CompanyInfo::generateUniqueSlug($record->address);
            $record->update(['slug' => $slug]);

            $this->info("Updated: ID {$record->id} => {$slug}");
        }

        $this->info("Hoàn thành!");
    }
}
