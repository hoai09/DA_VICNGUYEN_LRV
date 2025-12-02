<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactAdvice;
use App\Models\CategoriesProject;

class ContactAdviceController extends Controller    //FORM FE
{
    public function create()
    {
        $categories = CategoriesProject::all();
        return view('sitevicnguyen.infomation', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'category_id'        => 'required|exists:categories_project,id',
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'email.email' => 'Email không hợp lệ.',
        ]);

        ContactAdvice::create($request->all());

        return redirect()->back()->with('success', 'Thông tin đã được gửi thành công!');
    }
}
