<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::latest()->paginate(5);
        return view('admin.members.index', compact('members'));
    }

    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }
    
    /*==========================THÊM==================================*/
    public function create()
    {
        $projects = Project::orderBy('title')->get();
        return view('admin.members.create', compact('projects'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'graduation_year' => 'nullable|integer',
            'join_year' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
            'main_role' => 'required|string|max:255',
            // 'project_id' => 'required|array',
            // 'project_id.*' => 'required|integer',
            'awards' => 'nullable|string'
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('members', 'public')
            : null;

        $member = Member::create([
            'name' => $validated['name'],
            'slug' => Member::generateUniqueSlug($validated['name']),
            'graduation_year' => $validated['graduation_year'],
            'join_year' => $validated['join_year'],
            'awards' => $validated['awards'] ?? null,
            'image' => $imagePath,
            'main_role' => $validated['main_role'],
        ]);

        $member->projects()->sync($validated['project_id'] ?? []);

        return redirect()->route('admin.members.index')->with('success', 'Thêm thành viên thành công!');
    }


/*=========================SỬA===================================*/
    public function edit(Member $member)
    {
        $projects = Project::all();
        return view('admin.members.edit', compact('member', 'projects'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'graduation_year' => 'nullable|integer',
            'join_year' => 'nullable|integer',
            'main_role' => 'nullable|string|max:255',
            // 'project_id' => 'required|array',
            // 'project_id.*' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            'awards' => 'nullable|string'
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('members', 'public')
            : $member->image;

        $member->update([
            'name' => $validated['name'],
            'slug' => Member::generateUniqueSlug($validated['name'], $member->id),
            'graduation_year' => $validated['graduation_year'],
            'join_year' => $validated['join_year'],
            'awards' => $validated['awards'] ?? null,
            'image' => $imagePath,
            'main_role' => $validated['main_role'],
        ]);

        $member->projects()->sync($validated['project_id'] ?? []);

        return redirect()->route('admin.members.index')->with('success', 'Cập nhật thành công!');
    }

    /*============================XOÁ================================*/
    public function destroy(Member $member)
    {
        $member->projects()->detach();
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Xoá thành công');
    }
}
