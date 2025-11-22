<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    
    public function index()
    {
        $news = News::published()
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('sitevicnguyen.news', compact('news'));
    }

    public function detail($slug)
    {
        $news = News::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        $news->increment('view_count');

        $category = $news->category;

        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->where('is_published', true)
            ->latest()
            ->limit(4)
            ->get();

        return view('sitevicnguyen.chitiettintuc', compact('news', 'category', 'relatedNews'));
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->firstOrFail();

        $news = News::where('category_id', $category->id)
            ->where('is_published', true)
            ->latest()
            ->paginate(10);

        return view('sitevicnguyen.category', compact('category', 'news'));
    }
}
