<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProjectImage; 

class FixProjectImageSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:project-image-slug';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description =  'Tạo slug cho tất cả bản ghi project_images chưa có slug';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $images = ProjectImage::whereNull('slug')
                    ->orWhere('slug', '')
                    ->get();

        if ($images->isEmpty()) {
            $this->info("Không có ảnh nào cần cập nhật slug.");
            return 0;
    }

    foreach ($images as $img) {

        $baseTitle = $img->caption ?: pathinfo($img->image_path, PATHINFO_FILENAME);

        $img->slug = ProjectImage::generateUniqueSlug($baseTitle, $img->id);
        $img->save();

        $this->info("ID {$img->id} → slug: {$img->slug}");
    }

    $this->info("Hoàn tất cập nhật slug cho dữ liệu cũ!");
    return 0;
}
}
