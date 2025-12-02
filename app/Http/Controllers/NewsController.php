<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    
    public function index()
    {
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->paginate(5);

        return view('sitevicnguyen.news', compact('news'));
    }

    public function detail($slug)
    {
        $news = News::where('slug', $slug)
            ->firstOrFail();

        $news->increment('view_count');

        $relatedNews = News::where('slug', '!=', $news->slug)
            ->where('is_published', true)
            ->latest()
            ->limit(5)
            ->get();

        return view('sitevicnguyen.chitiettintuc', compact('news', 'relatedNews'));
    }

}
