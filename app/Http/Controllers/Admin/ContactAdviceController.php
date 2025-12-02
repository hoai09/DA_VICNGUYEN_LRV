<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactAdvice;
use App\Models\CategoriesProject;
use Illuminate\Http\Request;

class ContactAdviceController extends Controller   // FORM
{
    public function index(Request $request)
    {
        $information = ContactAdvice::latest()->paginate(10);
        return view('admin.form.index', compact('information'));

    }

    public function show(ContactAdvice $form)
    {
        return view('admin.form.show', ['information' => $form]);
    }
    
    public function destroy(ContactAdvice $form)
    {
        $form->delete();
        return redirect()->route('admin.form.index')
                        ->with('success', 'Thông tin đã được xóa thành công.');
    }

    public function updateStatus(ContactAdvice $form)
{
    $form->status = !$form->status;
    $form->save();
    return back()->with('success', 'Cập nhật trạng thái thành công!');
}

}
