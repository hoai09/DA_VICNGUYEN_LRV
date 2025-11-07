<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectInformation;

class ProjectInformationController extends Controller
{
    public function create()
    {
        // Trả về trang form thông tin dự án
        return view('sitevicnguyen.infomation');
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu cơ bản
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ], [
            'full_name.required' => 'Vui lòng nhập họ và tên.',
            'email.email' => 'Email không hợp lệ.',
        ]);

        // Lưu dữ liệu vào database
        ProjectInformation::create($request->all());

        // Chuyển hướng + thông báo thành công
        return redirect()->back()->with('success', 'Thông tin đã được gửi thành công!');
    }
}
