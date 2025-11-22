<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectInformation;
use Illuminate\Http\Request;

class ProjectInformationController extends Controller
{
    public function index()
    {
        $informations = ProjectInformation::latest()->paginate(10);
        return view('admin.form.index', compact('informations'));
    }

    public function show(ProjectInformation $information)
    {
        return view('admin.form.show', compact('information'));
    }

    public function destroy(ProjectInformation $information)
    {
        $information->delete();
        return redirect()->route('admin.form.index')
                        ->with('success', 'Thông tin đã được xóa thành công.');
    }
}
