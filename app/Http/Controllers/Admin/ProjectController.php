<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Project;
use App\Models\CategoriesProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    //danh sách
    public function index()
    {
        $template = 'admin.projects.index';
        $projects = Project::with('user')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.dashboard.layout', compact('template', 'projects'));
    }

    //TẠo mới
    public function create()
    {
        $template = 'admin.projects.create';
        $members = Member::all();
        $categories = CategoriesProject::all();

        return view('admin.dashboard.layout', compact('template', 'members', 'categories'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'category_id' => 'nullable|integer|exists:categories_project,id',
            'address' => 'nullable|string',
            'acreage' => 'nullable|string',
            'start_year' => 'nullable|integer',
            'end_year' => 'nullable|integer',
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|string|max:255',
        ]);

        $project = Project::create([
            'title' => $validated['title'],
            'slug' => Project::generateUniqueSlug($validated['title']),
            'category_id' => $validated['category_id'] ?? null,
            'address' => $validated['address'] ?? null,
            'acreage' => $validated['acreage'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'start_year' => $validated['start_year'] ?? null,
            'end_year' => $validated['end_year'] ?? null,
            'created_by' => auth()->id(),
        ]);

        $this->syncMembers($project, $request);

        return redirect()->route('admin.projects.index')->with('success', 'Tạo dự án thành công!');
    }

    //hiển thị chi tiết
    public function show(Project $project)
    {
        $project->load('user', 'members');
        return view('admin.projects.show', compact('project'));
    }

    //sửa
    public function edit(Project $project)
    {
        $template = 'admin.projects.edit';
        $members = Member::all();
        $categories = CategoriesProject::all();
        return view('admin.dashboard.layout', compact('template', 'project', 'members', 'categories'));
    }

    //cập nhật
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'category_id' => 'nullable|integer|exists:categories_project,id',
            'address' => 'nullable|string',
            'acreage' => 'nullable|string',
            'start_year' => 'nullable|integer',
            'end_year' => 'nullable|integer',
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|string|max:255',
        ]);

        $slug = $project->slug;
        if ($validated['title'] !== $project->title) {
            $slug = Project::generateUniqueSlug($validated['title'], $project->id);
        }

        $project->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'category_id' => $validated['category_id'] ?? null,
            'address' => $validated['address'] ?? null,
            'acreage' => $validated['acreage'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'start_year' => $validated['start_year'] ?? null,
            'end_year' => $validated['end_year'] ?? null,
        ]);

        $this->syncMembers($project, $request);

        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật thành công!');
    }

    //xoá
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Xoá thành công!');
    }

    //tạo loại da
    public function storeAjax(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories_project,name',
        ]);

        $category = CategoriesProject::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thêm danh mục thành công!',
            'category' => $category,
        ]);
    }

    //xoá loại da
    public function deleteAjax($id)
    {
        $category = CategoriesProject::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy loại dự án!',
            ], 404);
        }

        if ($category->projects()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xoá vì vẫn còn dự án sử dụng!',
            ], 400);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xoá thành công!',
        ]);
    }

    // thành viên và vai trò
    protected function syncMembers(Project $project, Request $request)
    {
        $syncData = [];
        $members = $request->input('members', []);
        $roles = $request->input('roles', []);

        foreach ($members as $memberId) {
            $syncData[$memberId] = [
                'role' => $roles[$memberId] ?? ''
            ];
        }

        $project->members()->sync($syncData);
    }
}
