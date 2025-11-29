<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactAdvice;

class ContactAdviceController extends Controller    //FORM FE
{
    public function create()
    {
        return view('sitevicnguyen.infomation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'email.email' => 'Email không hợp lệ.',
        ]);

        ContactAdvice::create($request->all());

        return redirect()->back()->with('success', 'Thông tin đã được gửi thành công!');
    }
}
