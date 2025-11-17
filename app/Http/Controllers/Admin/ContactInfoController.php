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
    public function show(ContactInfo $contactInfos)
    {
        return view('admin.contact_info.show',compact('contactInfos'));
    }

    public function edit($id)
    {
        $contactInfos = ContactInfo::findOrFail($id);
        return view('admin.contact_info.edit', compact('contactInfos'));
    }

    public function update(Request $request, ContactInfo $contactInfos)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'map_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('contactInfos', 'public');
        } else {
            $path = $contactInfo->map_image;
        }

        $contactInfos->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'map_image' => $path,
        ]);
        
        return redirect()->route('admin.contact_info.index')
            ->with('success', 'Cập nhật thông tin liên hệ thành công!');
    }

    public function destroy(ContactInfo $contactInfos)
    {
        $contactInfos->delete();
        return redirect()->route('admin.contact_info.index')
            ->with('success', 'Đã xóa thông tin liên hệ!');
    }
}
