<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    
    public function editContact()
    {
        $template = 'admin.company_info.contact';
        $contact = CompanyInfo::firstOrCreate(['type' => 'contact']);
        return view('admin.dashboard.layout', compact('template', 'contact'));
    }

    
    //Cập nhật thông tin liên hệ.
    
    public function updateContact(Request $request)
    {
        $contact = CompanyInfo::firstOrCreate(['type' => 'contact']);

        $validated = $request->validate([
            'address'   => 'required|string|max:255',
            'email'     => 'nullable|email|max:255',
            'phone'     => 'nullable|string|max:50',
            'map_image' => 'nullable|image|max:2048',
        ]);

        $path = $contact->map_image;
        if ($request->hasFile('map_image')) {
            $path = $request->file('map_image')->store('companyInfos', 'public');
        }

        $contact->update([
            'address'   => $validated['address'],
            'email'     => $validated['email'] ?? null,
            'phone'     => $validated['phone'] ?? null,
            'map_image' => $path,
        ]);

        return redirect()->back()->with('success', 'Cập nhật thông tin liên hệ thành công!');
    }

    
    // Hiển thị form chỉnh sửa thông tin social links.
    
    public function editSocial()
    {
        $template = 'admin.company_info.social';
        $social = CompanyInfo::firstOrCreate(['type' => 'social']);
        return view('admin.dashboard.layout', compact('template', 'social'));
    }

    
    //Cập nhật thông tin social links.
    
    public function updateSocial(Request $request)
    {
        $social = CompanyInfo::firstOrCreate(['type' => 'social']);

        $validated = $request->validate([
            'facebook'     => 'nullable|url|max:255',
            'instagram'    => 'nullable|url|max:255',
            'email_social' => 'nullable|email|max:255',
        ]);

        $socialLinks = [
            'facebook'     => $validated['facebook']     ?? null,
            'instagram'    => $validated['instagram']    ?? null,
            'email_social' => $validated['email_social'] ?? null,
        ];

        $social->update([
            'social_links' => $socialLinks
        ]);

        return redirect()->back()->with('success', 'Cập nhật social links thành công!');
    }

    
    //Hiển thị form chỉnh sửa thông tin studio.
    
    public function editStudio()
    {
        $template = 'admin.company_info.studio';
        $studio = CompanyInfo::firstOrCreate(['type' => 'studio']);
        return view('admin.dashboard.layout', compact('template', 'studio'));
    }

    
    //Cập nhật thông tin studio.
    
    public function updateStudio(Request $request)
    {
        $studio = CompanyInfo::firstOrCreate(['type' => 'studio']);

        $validated = $request->validate([
            'studio_image'   => 'nullable|image|max:2048',
            'studio_content' => 'nullable|string|max:1000',
            'awards'         => 'nullable|string|max:5000',
        ]);

        $path_image = $studio->studio_image;
        if ($request->hasFile('studio_image')) {
            $path_image = $request->file('studio_image')->store('companyInfos', 'public');
        }

        $awards = [];
        if (!empty($validated['awards'])) {
            $awards = array_filter(array_map('trim', explode(PHP_EOL, $validated['awards'])));
        }

        $studio->update([
            'studio_content' => $validated['studio_content'] ?? null,
            'awards'         => $awards,
            'studio_image'   => $path_image
        ]);

        return redirect()->back()->with('success', 'Cập nhật thông tin studio thành công!');
    }
}