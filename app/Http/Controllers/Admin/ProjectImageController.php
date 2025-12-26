<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    
    public function index()
    {
        $template = 'admin.project_images.index';
        $images = ProjectImage::with('project')
            ->orderByDesc('created_at')
            ->paginate(12);

        return view('admin.dashboard.layout', compact('template', 'images'));
    }

    
    public function create()
    {
        $template = 'admin.project_images.create';
        $projects = Project::all();

        return view('admin.dashboard.layout', compact('template', 'projects'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'images'     => 'required|array',
            'images.*'   => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                ProjectImage::create([
                    'project_id' => $validated['project_id'],
                    'image_path' => $path,
                    'caption'    => null,
                ]);
            }
        }

        return redirect()
            ->route('admin.project_images.index')
            ->with('success', 'Ảnh đã được tải lên thành công.');
    }

    //hiển thị ảnh
    public function show(ProjectImage $projectImage)
    {
        $template = 'admin.project_images.show';
        return view('admin.dashboard.layout', compact('template', 'projectImage'));
    }

    //xoá ảnh
    public function destroy(ProjectImage $projectImage)
    {
        if (Storage::disk('public')->exists($projectImage->image_path)) {
            Storage::disk('public')->delete($projectImage->image_path);
        }
        $projectImage->delete();

        return back()->with('success', 'Đã xoá ảnh thành công.');
    }
}
