<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function detail()
    {

        $projects = Project::with('members')->find($id);
        return view('sitevicnguyen.project', compact('projects'));
    }
    public function show($slug)
    {
    $project = Project::where('slug', $slug)
        ->with(['images', 'members'])
        ->firstOrFail();

    return view('sitevicnguyen.project', compact('project'));
    }

}
