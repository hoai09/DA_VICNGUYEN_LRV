<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Gallery;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $members = Member::all();
        return view('admin.projects.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|string',
        'title' => 'required|string|max:255',
        'category' => 'nullable|string',
        'address' => 'nullable|string',
        'acreage' => 'nullable|string',
    ]);

    Project::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'category' => $request->category,
        'address' => $request->address,
        'acreage' => $request->acreage,
        'description' => $request->description,
        'status' => $request->status,
        'start_year' => $request->start_year,
        'end_year' => $request->end_year,
    ]);

    if($request->members){
        // Tách roles theo dấu phẩy
        $roles = array_map('trim', explode(',', $request->roles ?? ''));
    
        foreach($request->members as $index => $memberId){
            $role = $roles[$index] ?? null;  // map theo thứ tự
            $project->members()->attach($memberId, ['role' => $role]);
        }
    }
            return redirect()->route('admin.projects.index')->with('success', 'Tạo dự án thành công!');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $members = Member::all();
    return view('admin.projects.edit', compact('project', 'members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'title' => 'required|string|max:255',
            'category' => 'nullable|string',
            'address' => 'nullable|string',
            'acreage' => 'nullable|string',
    
    
        ]);

        $project->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'category' => $request->category,
            'address' => $request->address,
            'acreage' => $request->acreage,
            'description' => $request->description,
            'status' => $request->status,
            'start_year' => $request->start_year,
            'end_year' => $request->end_year,
        ]);

        $project->members()->detach(); // xoá hết trước (update)

if($request->members){
    foreach($request->members as $memberId){
        $role = $request->roles[$memberId] ?? null; // Lấy role trực tiếp
        $project->members()->attach($memberId, ['role' => $role]);
    }
}


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
