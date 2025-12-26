<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    
    // Danh sách thành viên
    
    public function index()
    {
        $template = 'admin.members.index';
        $members = Member::latest()->paginate(5);
        return view('admin.dashboard.layout', compact('template', 'members'));
    }

    
    // Chi tiết 
    
    public function show(Member $member)
    {
        $template = 'admin.members.show';
        return view('admin.dashboard.layout', compact('template', 'member'));
    }

    
    // tạo mới thành viên
    
    public function create()
    {
        $template = 'admin.members.create';
        $projects = Project::orderBy('title')->get();
        return view('admin.dashboard.layout', compact('template', 'projects'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|min:2|max:255',
            'site'             => 'required|string|in:design,VicNguyen',
            'graduation_year'  => 'nullable|integer',
            'join_year'        => 'nullable|integer',
            'image'            => 'nullable|image|max:2048',
            'main_role'        => 'required|string|max:255',
            'awards'           => 'nullable|string',
        ]);

        $imagePath = $request->file('image')
            ? $request->file('image')->store('members', 'public')
            : null;

        $member = Member::create([
            'name'             => $validated['name'],
            'slug'             => Member::generateUniqueSlug($validated['name']),
            'site'             => $validated['site'],
            'graduation_year'  => $validated['graduation_year'],
            'join_year'        => $validated['join_year'],
            'awards'           => $validated['awards'] ?? null,
            'image'            => $imagePath,
            'main_role'        => $validated['main_role'],
        ]);

        $this->syncProjects($member, $request);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Thêm thành viên thành công!');
    }

    //sửa
    public function edit(Member $member)
    {
        $template = 'admin.members.edit';
        $projects = Project::orderBy('title')->get();
        return view('admin.dashboard.layout', compact('template', 'member', 'projects'));
    }

    //cập nhật
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name'             => 'required|string|min:2|max:255',
            'site'             => 'required|string|in:design,VicNguyen',
            'graduation_year'  => 'nullable|integer',
            'join_year'        => 'nullable|integer',
            'main_role'        => 'nullable|string|max:255',
            'image'            => 'nullable|image|max:2048',
            'awards'           => 'nullable|string',
        ]);

        $imagePath = $member->image;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('members', 'public');
        }

        $member->update([
            'name'             => $validated['name'],
            'slug'             => Member::generateUniqueSlug($validated['name'], $member->id),
            'site'             => $validated['site'],
            'graduation_year'  => $validated['graduation_year'],
            'join_year'        => $validated['join_year'],
            'awards'           => $validated['awards'] ?? null,
            'image'            => $imagePath,
            'main_role'        => $validated['main_role'],
        ]);

        $this->syncProjects($member, $request);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Cập nhật thành công!');
    }

    //xoá
    public function destroy(Member $member)
    {
        $member->projects()->detach();
        if ($member->image && Storage::disk('public')->exists($member->image)) {
            Storage::disk('public')->delete($member->image);
        }
        $member->delete();

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Xoá thành công');
    }

    
    // Đồng bộ dự án với vai trò khi tạo hoặc cập nhật
    
    private function syncProjects(Member $member, Request $request)
    {
        if ($request->has('project_id')) {
            $syncData = [];
            foreach ($request->project_id as $projectId) {
                $syncData[$projectId] = [
                    'role' => $request->roles[$projectId] ?? null
                ];
            }
            $member->projects()->sync($syncData);
        } else {
            $member->projects()->sync([]);
        }
    }
}
