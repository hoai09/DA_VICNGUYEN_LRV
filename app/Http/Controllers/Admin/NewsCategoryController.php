<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    // Danh sách loại tin
    public function index()
    {
        $categories = NewsCategory::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.news_categories.index', compact('categories'));
    }

    // Form tạo mới
    public function create()
    {
        return view('admin.news_categories.create');
    }

    // Lưu loại tin mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name',
            'description' => 'nullable|string',
        ]);

        NewsCategory::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.news_categories.index')
            ->with('success', 'Thêm loại tin thành công!');
    }

    // Xem chi tiết
    public function show($id)
    {
        $categories = NewsCategory::findOrFail($id);
        return view('admin.news_categories.index', compact('categories'));
    }

    // Form chỉnh sửa
    public function edit($id)
    {
        $categories = NewsCategory::findOrFail($id);
        return view('admin.news_categories.edit', compact('categories'));
    }

    // Cập nhật loại tin
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string'
    ]);

    $category = NewsCategory::findOrFail($id);

    $category->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.news_categories.index')
        ->with('success', 'Cập nhật loại tin thành công!');
}


    // Xóa loại tin
    public function destroy($id)
    {
        $categories = NewsCategory::findOrFail($id);

        // Nếu muốn: ngăn xóa categories có tin tức
        if ($categories->news()->count() > 0) {
            return back()->with('error', 'Không thể xóa vì đang có tin tức thuộc loại này!');
        }

        $categories->delete();

        return redirect()->route('admin.news_categories.index')
            ->with('success', 'Xóa loại tin thành công!');
    }
}
