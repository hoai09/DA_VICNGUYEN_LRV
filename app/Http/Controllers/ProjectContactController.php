<?php

namespace App\Http\Controllers;

use App\Models\Projectcontact;
use Illuminate\Http\Request;

class ProjectContactController extends Controller
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

        Projectcontact::create($request->only(['name', 'email', 'objects', 'content']));


        return redirect()->back()->with('success', 'Thông tin đã được gửi thành công!');
    }
    
}
