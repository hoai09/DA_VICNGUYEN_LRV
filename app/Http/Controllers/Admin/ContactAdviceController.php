<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactAdvice;
use Illuminate\Http\Request;

class ContactAdviceController extends Controller
{
    
    //Hiển thị danh sách thông tin yêu cầu tư vấn.
    
    public function index(Request $request)
    {
        $template = 'admin.form.index';
        $information = ContactAdvice::latest()->paginate(10);

        return view('admin.dashboard.layout', compact('template', 'information'));
    }

    
    // Hiển thị thông tin chi tiết yêu cầu tư vấn.
    
    public function show(ContactAdvice $form)
    {
        if ($form->status == 0) {
            $form->update(['status' => 1]);
        }

        $template = 'admin.form.show';
        $information = $form;

        return view('admin.dashboard.layout', compact('template', 'information'));
    }

    
    //Xóa một yêu cầu .
    
    public function destroy(ContactAdvice $form)
    {
        $form->delete();

        return redirect()
            ->route('admin.form.index')
            ->with('success', 'Thông tin đã được xóa thành công.');
    }

    
    // Cập nhật trạng thái.
    
    public function updateStatus(ContactAdvice $form)
    {
        $form->status = !$form->status;
        $form->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }
}
