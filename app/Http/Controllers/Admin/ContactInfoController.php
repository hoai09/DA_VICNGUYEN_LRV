<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contactInfos = ContactInfo::latest()->paginate(10);
        return view('admin.contact_info.index', compact('contactInfos'));
    }

    public function create()
    {
        return view('admin.contact_info.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'map_image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('map_image')) {
            $imagePath = $request->file('map_image')->store('contactInfos', 'public');
        }

        ContactInfo::create([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'map_image' => $imagePath,
        ]);

        return redirect()->route('admin.contact_info.index')
            ->with('success', 'Thêm thông tin liên hệ thành công!');
    }

    public function show(ContactInfo $contactInfo)
    {
        return view('admin.contact_info.show', compact('contactInfo'));
    }

    public function edit(ContactInfo $contactInfo)
    {
        return view('admin.contact_info.edit', compact('contactInfo'));
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'map_image' => 'nullable|image|max:2048',
        ]);

        // xử lý ảnh
        if ($request->hasFile('map_image')) {
            $path = $request->file('map_image')->store('contactInfos', 'public');
        } else {
            $path = $contactInfo->map_image;
        }

        $contactInfo->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'map_image' => $path,
        ]);

        return redirect()->route('admin.contact_info.index')
            ->with('success', 'Cập nhật thông tin liên hệ thành công!');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();

        return redirect()->route('admin.contact_info.index')
            ->with('success', 'Đã xóa thông tin liên hệ!');
    }
}
