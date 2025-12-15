<?php

namespace App\Http\Controllers;

use App\Models\Portfolio_Contact;
use Illuminate\Http\Request;

class PortfolioContactController extends Controller   // FORM cái ni là của site design em xử lí form bữa trước ạ k phải của cái ui ni
{
    public function create()
    {
        return view('sitevicnguyendesign.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'objects' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên.',
            'email.email' => 'Email không hợp lệ.',
        ]);

        Portfolio_Contact::create($request->only(['name', 'email', 'objects', 'content']));

        return redirect()->back()->with('success', 'Thông tin đã được gửi thành công!');
    }
    
}
