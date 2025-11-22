<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.news_categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = NewsCategory::whereNull('parent_id')->orderBy('name')->get();
        return view('admin.news_categories.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'parent_id' => 'nullable|exists:news_categories,id',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) 
        {
            $imagePath = $request->file('image')->store('uploads/news-category', 'public');
        }
        NewsCategory::create([
            'name' => $request->name,
            'slug' => NewsCategory::generateUniqueSlug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'image' => $imagePath,
            'order' => $request->order ?? 0,
            'status' => $request->boolean('status'),
            'meta_title' => $request->meta_title ?? $request->name,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        return redirect()->route('admin.news_categories.index')
            ->with('success', 'Thêm loại tin thành công!');
    }

    public function show($slug)
    {
        $category = NewsCategory::where('slug', $slug)->firstOrFail();
        return view('admin.news_categories.index', compact('category'));
    }

    public function edit($slug)
    {
        $category = NewsCategory::where('slug',$slug)->firstOrFail();
        $categories = NewsCategory::where('id', '!=', $category->id)->orderBy('name')->get();
        return view('admin.news_categories.edit', compact('category','categories'));
    }

    public function update(Request $request, $slug)
    {

    $category = NewsCategory::where('slug',$slug)->firstOrFail();

    $request->validate([
        'name' => 'required|string|max:255|unique:news_categories,name,' . $category->id,
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'parent_id' => 'nullable|exists:news_categories,id|not_in:' . $category->id,
        'order' => 'nullable|integer',
        'status' => 'nullable|boolean',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
    ]);

    $imagePath = $category->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/news-category', 'public');
        }

        
    $category->update([
        'name' => $request->name,
        'slug' => NewsCategory::generateUniqueSlug($request->name),
        'description' => $request->description,
        'parent_id' => $request->parent_id,
        'image' => $imagePath,
        'order' => $request->order ?? 0,
        'status' => $request->boolean('status'),
        'meta_title' => $request->meta_title ?? $request->name,
        'meta_description' => $request->meta_description,
        'meta_keywords' => $request->meta_keywords,
    ]);

    return redirect()->route('admin.news_categories.index')
        ->with('success', 'Cập nhật loại tin thành công!');
    }

    public function destroy($slug)
    {
        $category = NewsCategory::where('slug',$slug)->firstOrFail();

        if ($category->news()->count() > 0) {
            return back()->with('error', 'Không thể xóa vì đang có tin tức thuộc loại này!');
        }

        if ($category->children()->count() > 0) {
            return back()->with('error', 'Không thể xóa vì danh mục này có danh mục con!');
        }

        $category->delete();

        return redirect()->route('admin.news_categories.index')
            ->with('success', 'Xóa loại tin thành công!');
    }
}
