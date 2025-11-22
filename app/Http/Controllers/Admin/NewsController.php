<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with(['category', 'author']);
        if ($request->status === 'published') {
            $query->where('is_published', true);
        } elseif ($request->status === 'draft') {
            $query->where('is_published', false);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        $news = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::orderBy('name')->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:news_categories,id',
            'title' => 'required|string|max:255|unique:news,title',
            'feature_image' => 'nullable|image|max:2048',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
            'featured_news' => 'nullable|boolean',
            'latest_news' => 'nullable|boolean',
        ]);

        $imagePath = $request->file('feature_image')?->store('uploads/news', 'public');
        $publishedAt = $request->has('is_published') ? Carbon::now('Asia/Ho_Chi_Minh') : null;
        News::create([
            'category_id'=> $validated['category_id'],
            'title' => $validated['title'],
            'slug'             => News::generateUniqueSlug($validated['title']),
            'summary'          => $validated['summary'] ?? null,
            'content'          => $validated['content'],
            'feature_image'    => $imagePath,
            'featured_news'    => $request->boolean('featured_news'),
            'latest_news'      => $request->boolean('latest_news'),
            'published_at'     => $publishedAt,
            'is_published'     => $request->has('is_published'),
            'author_id'        => Auth::id(),
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'view_count'       => 0,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Thêm tin tức thành công!');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:news_categories,id',
            'title' => 'required|string|max:255|unique:news,title,' . $news->id,
            'feature_image' => 'nullable|image|max:2048',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
            'featured_news' => 'nullable|boolean',
            'latest_news' => 'nullable|boolean',
        ]);

        $imagePath = $news->feature_image;
        if ($request->hasFile('feature_image')) {
            if ($news->feature_image && \Storage::disk('public')->exists($news->feature_image)) {
                \Storage::disk('public')->delete($news->feature_image);
            }
            $imagePath = $request->file('feature_image')->store('uploads/news', 'public');
        }

        $publishedAt = $request->has('is_published')
            ? ($news->published_at ?? now('Asia/Ho_Chi_Minh'))
            : null;

        $news->update([
            'category_id'      => $validated['category_id'],
            'title'            => $validated['title'],
            'slug'             => News::generateUniqueSlug($validated['title'], $news->id),
            'summary'          => $validated['summary'] ?? null,
            'content'          => $validated['content'],
            'feature_image'    => $imagePath,
            'featured_news'    => $request->boolean('featured_news'),
            'latest_news'      => $request->boolean('latest_news'),
            'published_at'     => $publishedAt,
            'is_published'     => $request->has('is_published'),
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công!');
    }

    public function destroy(News $news)
    {
        if ($news->feature_image && \Storage::disk('public')->exists($news->feature_image)) {
            \Storage::disk('public')->delete($news->feature_image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Xóa tin tức thành công!');
    }
    

}
