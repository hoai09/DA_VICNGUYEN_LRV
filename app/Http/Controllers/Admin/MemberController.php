<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Project; 

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('created_at')->paginate(5);
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        $projects = Project::orderBy('title')->get();
        return view('admin.members.create',compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'graduation_year' => 'nullable|integer',
            'join_year' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
            'role' => 'required|string|max:255',
            'project_id' => 'required|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('members', 'public');
        }

        $member =Member::create([
            'name' => $request->name,
            'graduation_year' => $request->graduation_year,
            'join_year' => $request->join_year,
            'awards' => $request->awards,
            'image' => $request->image?->store('members', 'public'),
        ]);
        if ($request->filled('project_id')) 
        {
        $member->projects()->attach($request->project_id, [
            'role' => $request->role,
        ]);
    }
        return redirect()->route('admin.members.index')->with('success', 'Thêm thành viên thành công!');
    }

    public function show(Member $member)
    {
        return view('admin.members.show',compact('member'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $projects = Project::all();
        return view('admin.members.edit', compact('member','projects'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'graduation_year' => 'nullable|integer',
            'join_year' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
            'role' => 'required|string|max:255',
            'project_id' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('members', 'public');
        } else {
            $imagePath = $member->image;
        }

        $member->update([
            'name' => $request->name,
            'graduation_year' => $request->graduation_year,
            'join_year' => $request->join_year,
            'awards' => $request->awards,
            'image' => $imagePath,
        ]);
        $member->projects()->sync([
            $request->project_id => ['role' => $request->role]
        ]);
        return redirect()->route('admin.members.index')->with('success', 'Cập nhật thành công!');
        
    }

    public function destroy (Member $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success','Xoá thành công');
    }
}
