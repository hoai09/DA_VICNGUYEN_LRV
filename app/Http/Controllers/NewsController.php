<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::all();
        return view('sitevicnguyen.news',compact('news'));
    }
    

    public function detail($id)
    {
        $newsDetail = News::with('category')->findOrFail($id);
        $relatedNews = News::where('category_id', $newsDetail->category_id)
            ->where('id', '!=', $newsDetail->id)
            ->latest()
            ->limit(4)
            ->get();
        return view('sitevicnguyen.chitiettintuc', compact('newsDetail','relatedNews'));
    }
    
    

}
