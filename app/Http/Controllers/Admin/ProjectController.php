<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CategoriesProject;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = Project::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $members = Member::all();
        $categories = CategoriesProject::all();
        return view('admin.projects.create', compact('members','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|string',
        'category_id' => 'nullable|integer|exists:categories_project,id',//
        'address' => 'nullable|string',
        'acreage' => 'nullable|string',
        'members' => 'nullable|array',
        'members.*' => 'exists:members,id',
        'roles' => 'nullable|array',
        'roles.*' => 'nullable|string|max:255',
        ]);

        $project = Project::create([
        'title' => $validated['title'],
        'slug'=> Project::generateUniqueSlug($validated['title']),
        'category_id' => $request->category_id,//
        'address' => $request->address,
        'acreage' => $request->acreage,
        'description' => $request->description,
        'status' => $request->status,
        'start_year' => $request->start_year,
        'end_year' => $request->end_year,
        'created_by' => auth()->id(),
        ]);


        $syncData = [];
        if ($request->has('members')) {
            foreach($request->members as $memberId){
                $syncData[$memberId] = ['role' => $request->roles[$memberId] ?? ''];
            }
        }
        $project->members()->sync($syncData);
        

        return redirect()->route('admin.projects.index')->with('success', 'Tạo dự án thành công!');
    }

    public function storeAjax(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories_project,name'
    ]);

    $category = CategoriesProject::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Thêm danh mục thành công!',
        'category' => $category
    ]);
}

public function deleteAjax($id)
    {
        $category = CategoriesProject::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy loại dự án!'
            ], 404);
        }

        if ($category->projects()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xoá vì vẫn còn dự án sử dụng!'
            ], 400);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Đã xoá thành công!'
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('user', 'members');
        return view('admin.projects.show', compact('project'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $members = Member::all();
        $categories = CategoriesProject::all();//
        return view('admin.projects.edit', compact('project', 'members', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'category_id' => 'nullable|integer|exists:categories_project,id',//
            'address' => 'nullable|string',
            'acreage' => 'nullable|string',
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
            'roles' => 'nullable|array',
            'roles.*' => 'nullable|string|max:255',
        ]);

        $slug = $project->slug; //
        if ($validated['title'] !== $project->title) {
            $slug = Project::generateUniqueSlug($validated['title'], $project->id);
        }

        $project->update([
            'title' => $validated['title'],
            'slug'=> $slug,
            'category_id' => $validated['category_id'] ?? null,//
            'address' => $request->address,
            'acreage' => $request->acreage,
            'description' => $request->description,
            'status' => $request->status,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
        ]);

        $syncData = [];
if ($request->has('members')) {
    foreach($request->members as $memberId){
        $syncData[$memberId] = ['role' => $request->roles[$memberId] ?? ''];
    }
}
$project->members()->sync($syncData);

        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Xoá thành công!');
    }
}
