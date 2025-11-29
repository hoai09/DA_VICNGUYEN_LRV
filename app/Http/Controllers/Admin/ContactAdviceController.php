<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactAdvice;
use Illuminate\Http\Request;

class ContactAdviceController extends Controller   // FORM
{
    public function index()
    {
        $information = ContactAdvice::latest()->paginate(10);
        return view('admin.form.index', compact('information'));
    }

    public function show(ContactAdvice $information)
    {
        return view('admin.form.show', compact('information'));
    }
    
    public function destroy(ContactAdvice $information)
    {
        $information->delete();
        return redirect()->route('admin.form.index')
                        ->with('success', 'Thông tin đã được xóa thành công.');
    }
}
