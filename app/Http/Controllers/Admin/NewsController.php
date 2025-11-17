<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::orderBy('name')->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:news_categories,id',
            'title' => 'required|string|max:255',
            'feature_image' => 'nullable|image|max:2048',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('feature_image')) {
            $imagePath = $request->file('feature_image')->store('uploads/news', 'public');
        }

        $publishedAt = $request->has('is_published') ? Carbon::now('Asia/Ho_Chi_Minh') : null;

        News::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'summary' => $request->summary,
            'content' => $request->content,
            'feature_image' => $imagePath,
            'published_at' => $publishedAt,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Thêm tin tức thành công!');
    }
    public function show(News $news)
    {
        return view('admin.news.show',compact('news'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'category_id' => 'required|exists:news_categories,id',
            'title' => 'required|string|max:255',
            'feature_image' => 'nullable|image|max:2048',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        $imagePath = $news->feature_image;

        if ($request->hasFile('feature_image')) {
            $imagePath = $request->file('feature_image')->store('uploads/news', 'public');
        }

        $publishedAt = $request->has('is_published') ? Carbon::now('Asia/Ho_Chi_Minh') : null;

        $news->update([
            'category_id'   => $request->category_id,
            'title'         => $request->title,
            'summary'       => $request->summary,
            'content'       => $request->content,
            'feature_image' => $imagePath,
            'published_at'  => $publishedAt,
            'is_published'  => $request->has('is_published'),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công!');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Xóa tin tức thành công!');
    }
}
