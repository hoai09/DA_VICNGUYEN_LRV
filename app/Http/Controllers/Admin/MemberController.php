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
        $template = 'admin.members.index';
        $members = Member::latest()->paginate(5);
        return view('admin.dashboard.layout', compact('template','members'));
    }

    public function show(Member $member)
    {
        return view('admin.members.show', compact('member'));
    }
    
    /*==========================THÊM==================================*/
    public function create()
    {
        $template = 'admin.members.create';
        $projects = Project::orderBy('title')->get();
        return view('admin.dashboard.layout', compact('template','projects'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'graduation_year' => 'nullable|integer',
            'join_year' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
            'main_role' => 'required|string|max:255',
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

        if($request->has('project_id')) {
            $syncData = [];
            foreach($request->project_id as $projectId) {
                $syncData[$projectId] = [
                    'role' => $request->roles[$projectId] ?? null
                ];
            }
            $member->projects()->sync($syncData);
        } else {
            $member->projects()->sync([]);
        }
        
        return redirect()->route('admin.members.index')->with('success', 'Thêm thành viên thành công!');
    }


/*=========================SỬA===================================*/
    public function edit(Member $member)
    {
        $template = 'admin.members.edit';
        $projects = Project::all();
        return view('admin.dashboard.layout', compact('template','member', 'projects'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'graduation_year' => 'nullable|integer',
            'join_year' => 'nullable|integer',
            'main_role' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'awards' => 'nullable|string'
        ]);


        if ($request->hasFile('image')) {
            if ($member->image && \Storage::disk('public')->exists($member->image)) {
                \Storage::disk('public')->delete($member->image);
            }
            $imagePath = $request->file('image')->store('members', 'public');
        } else {
            $imagePath = $member->image;
        }
        
        $member->update([
            'name' => $validated['name'],
            'slug' => Member::generateUniqueSlug($validated['name'], $member->id),
            'graduation_year' => $validated['graduation_year'],
            'join_year' => $validated['join_year'],
            'awards' => $validated['awards'] ?? null,
            'image' => $imagePath,
            'main_role' => $validated['main_role'],
        ]);

        if($request->has('project_id')) {
            $syncData = [];
            foreach($request->project_id as $projectId) {
                $syncData[$projectId] = [
                    'role' => $request->roles[$projectId] ?? null
                ];
            }
            $member->projects()->sync($syncData);
        } else {
            $member->projects()->sync([]);
        }
        

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
