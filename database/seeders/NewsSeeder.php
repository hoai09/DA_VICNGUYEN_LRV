<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;
use Carbon\Carbon;


class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $content1 = <<<HTML
        <p>Text description provided by the architects. Anpha office was
            formed after some big changes regarding its function from the
            investor. At first, we were tasked with creating a house for 5
            family members, including a grandmother, a married couple and
            their two children. We are getting more accustomed to Saigon
            housing projects, however this construction has a big length, and
            we want to utilize that feature to create spaces that are
            interactive and connective for family members. We reserved a large
            portion of the length for the skylight, which is the main space to
            connect the rest of the spaces in the house, the activities, the
            balance between static and non-static, air movement, light and
            nature.</p>
        
        <figure>
            <img src="assets/img/TinTuc/chitiettin1.png" class="img-fluid" />
        </figure>
        
        <p>When the base of the construction was done, the investor shared
            with us his wish to convert the construction’s function to serve
            the purpose of running a mid-size family business, specializing in
            Medicine and Medical Equipment. This was the most difficult part
            for us during the whole project, since the construction base was
            done for a family housing. Fortunately, each office of Anpha
            company has only 5-8 employees, that makes utilizing the existing
            rooms feasible. We used glass walls to maximize the use of nature
            spaces from the skylight, so almost all of the working spaces are
            surrounded with two layers of nature, the company’s daily life is
            also more interesting since the employees can always see each
            other, they can indulge in the natural atmosphere, the freshness
            of the trees. This is a feature that we are sure offices in
            skyscrapers cannot benefit from.</p>
        
        <div class="row g-1 mb-5">
            <div class="col-5">
                <img src="assets/img/TinTuc/chitiettin2-1.png" class="img-fluid" />
            </div>
            <div class="col-7">
                <img src="assets/img/TinTuc/chitiettin2-2.png" class="img-fluid" />
            </div>
        </div>
        
        <figure>
            <img src="assets/img/TinTuc/chitiettin3.png" class="img-fluid" />
        </figure>
        
        <p>We’ve recordeded photos of Anpha company after 2 operation years,
            in order to fully understand that what we created were going in
            the right direction, and to serve as inspiration for our future
            projects.</p>
        HTML;

        $news = [
            [
                'title' => 'THE BACKYARD HOUSE | VIC DAILY',
                'feature_image' => '/assets/img/TinTuc/tin1.png',
                'summary' => 'LPHV là dự án nhà ở được thiết kế và xây dựng tại thành phố
                Vinh, Nghệ An. LPHV là một thiết kế tiện nghi trong sinh hoạt,
                gần gũi về cảm giác, quen thuộc về hình ảnh nhưng khởi gợi được
                những khám phá mới trong cấu trúc không gian sống truyền thống.',
                'content' => $content1,
            ],
            [
                'title' => 'Refuge in the Valley |Zanesco Arquitetura',
                'feature_image' => '/assets/img/TinTuc/Tin2.png',
                'summary' => 'LPHV là dự án nhà ở được thiết kế và xây dựng tại thành phố
                Vinh, Nghệ An. LPHV là một thiết kế tiện nghi trong sinh hoạt,
                gần gũi về cảm giác, quen thuộc về hình ảnh nhưng khởi gợi được
                những khám phá mới trong cấu trúc không gian sống truyền thống.',
                'content' => $content1,
            ],
            [
                'title' => 'Gia đình House | G+ architects',
                'feature_image' => '/assets/img/TinTuc/Tin3.png',
                'summary' => 'LPHV là dự án nhà ở được thiết kế và xây dựng tại thành phố
                Vinh, Nghệ An. LPHV là một thiết kế tiện nghi trong sinh hoạt,
                gần gũi về cảm giác, quen thuộc về hình ảnh nhưng khởi gợi được
                những khám phá mới trong cấu trúc không gian sống truyền thống.',
                'content' => $content1,
            ],
            [
                'title' => 'THE BACKYARD HOUSE | VIC DAILY',
                'feature_image' => '/assets/img/TinTuc/Tin4.png',
                'summary' => 'LPHV là dự án nhà ở được thiết kế và xây dựng tại thành phố
                Vinh, Nghệ An. LPHV là một thiết kế tiện nghi trong sinh hoạt,
                gần gũi về cảm giác, quen thuộc về hình ảnh nhưng khởi gợi được
                những khám phá mới trong cấu trúc không gian sống truyền thống.',
                'content' => $content1,
            ],
            [
                'title' => 'THE BACKYARD HOUSE | VIC DAILY',
                'feature_image' => '/assets/img/TinTuc/Tin5.png',
                'summary' => 'LPHV là dự án nhà ở được thiết kế và xây dựng tại thành phố
                Vinh, Nghệ An. LPHV là một thiết kế tiện nghi trong sinh hoạt,
                gần gũi về cảm giác, quen thuộc về hình ảnh nhưng khởi gợi được
                những khám phá mới trong cấu trúc không gian sống truyền thống.',
                'content' => $content1,
            ],
        ];

        foreach ($news as $item) {
            News::create([
                'title' => $item['title'],
                'feature_image' => $item['feature_image'],
                'summary' => $item['summary'],
                'content' => $item['content'],
                'published_at' => Carbon::now()->subDays(rand(0, 10)),
                'category_id' => 1,
                
            ]);
        }
    }
}
