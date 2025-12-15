<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\CategoriesNews;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with([ 'author']);
        if ($request->status === 'published') {
            $query->where('is_published', true);
        } elseif ($request->status === 'draft') {
            $query->where('is_published', false);
        }
        $template = 'admin.news.index';
        $news = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.dashboard.layout', compact('template','news'));
    }

    public function create()
    {
        $template = 'admin.news.create';
        $categories = CategoriesNews::all();
        return view('admin.dashboard.layout', compact('template','categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:news,title',
            'category_id' => 'nullable|integer|exists:categories_news,id',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            // 'latest_news' => 'nullable|boolean',
        ]);

        $imagePath = $request->file('image')?->store('uploads/news', 'public');
        $publishedAt = $request->has('is_published') ? Carbon::now('Asia/Ho_Chi_Minh') : null;
        News::create([
            'title' => $validated['title'],
            'slug'             => News::generateUniqueSlug($validated['title']),
            'category_id' => $validated['category_id'] ?? null,
            'description'          => $validated['description'] ?? null,
            'content'          => $validated['content'],
            'image'    => $imagePath,
            'is_featured'    => $request->boolean('is_featured'),
            // 'latest_news'      => $request->boolean('latest_news'),
            'published_at'     => $publishedAt,
            'is_published'     => $request->has('is_published'),
            'create_by'        => Auth::id(),
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'view_count'       => 0,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Thêm tin tức thành công!');
    }

    public function storeAjax(Request $request)//
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories_news,name'
    ]);

    $category = CategoriesNews::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
    ]);

    return response()->json([
        'success' => true,
        'category' => $category
    ]);
} 
    public function deleteAjax($id)
    {
        $category = CategoriesNews::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy thể loại!'
            ], 404);
        }

        if ($category->news()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xoá vì vẫn còn tin tức sử dụng!'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xoá thành công!'
        ]);
    }



    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $template = 'admin.news.edit';
        $categories = CategoriesNews::all();
        return view('admin.dashboard.layout', compact('template','news','categories'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:news,title,' . $news->id,
            'category_id' => 'nullable|integer|exists:categories_news,id',//
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            // 'latest_news' => 'nullable|boolean',
        ]);

        $imagePath = $news->image;
        if ($request->hasFile('image')) {
            if ($news->image && \Storage::disk('public')->exists($news->image)) {
                \Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('uploads/news', 'public');
        }

        $publishedAt = $request->has('is_published')
            ? ($news->published_at ?? now('Asia/Ho_Chi_Minh'))
            : null;

        $news->update([
            'title'            => $validated['title'],
            'slug'             => News::generateUniqueSlug($validated['title'], $news->id),
            'category_id' => $validated['category_id'] ?? null,
            'description'          => $validated['description'] ?? null,
            'content'          => $validated['content'],
            'image'    => $imagePath,
            'is_featured'    => $request->boolean('is_featured'),
            'published_at'     => $publishedAt,
            'is_published'     => $request->has('is_published'),
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Cập nhật tin tức thành công!');
    }

    public function destroy(News $news)
    {
        if ($news->image && \Storage::disk('public')->exists($news->image)) {
            \Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Xóa tin tức thành công!');
    }
    

}
