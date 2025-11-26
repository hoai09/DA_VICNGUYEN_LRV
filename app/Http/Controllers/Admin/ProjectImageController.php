<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectImageController extends Controller
{
    public function index()
    {
        $images = ProjectImage::with('project')->latest()->paginate(12);
        return view('admin.project_images.index', compact('images'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('admin.project_images.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('projects', 'public');
                $filename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                ProjectImage::create([
                    'project_id' => $request->project_id,
                    'image_path' => $path,
                    'caption' => null,
                    'slug' => ProjectImage::generateUniqueSlug($filename),
                ]);
            }
        }
        return redirect()
            ->route('admin.project_images.index')
            ->with('success', 'Ảnh đã được tải lên');
    }

    public function show(ProjectImage $projectImage)
    {
        return view('admin.project_images.show', compact('projectImage'));
    }

    public function destroy(ProjectImage $projectImage)
    {
        Storage::disk('public')->delete($projectImage->image_path);
        $projectImage->delete();
        return back()->with('success', 'Đã xoá ảnh.');
    }
}
