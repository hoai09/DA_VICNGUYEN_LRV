<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller    //address + studio + footer
{
/* =====================ADDRESS==============================*/

    public function editContact()
    {
        $template = 'admin.company_info.contact';
        $contact = CompanyInfo::firstOrCreate(['type'=>'contact']);
        return view('admin.dashboard.layout', compact('template','contact'));
    }

    public function updateContact(Request $request)
    {
        $contact = CompanyInfo::firstOrCreate(['type'=>'contact']);
        $request->validate([
            'address' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'map_image' => 'nullable|image|max:2048',
    ]);

        $path = $contact->map_image;
        if ($request->hasFile('map_image')) 
        {
            $path = $request->file('map_image')->store('companyInfos', 'public');
        }

        $contact->update
        ([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'map_image' => $path,
        ]);

        return redirect()->back()->with('success', 'Cập nhật thông tin liên hệ thành công!');
    }

/* =====================FOOTER==============================*/

    public function editSocial()
    {
        $template = 'admin.company_info.social';
        $social = CompanyInfo::firstOrCreate(['type'=>'social']);
        return view('admin.dashboard.layout', compact('template','social'));
    }

    public function updateSocial(Request $request)
    {
        $social = CompanyInfo::firstOrCreate(['type'=>'social']);

        $request->validate([
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'email_social' => 'nullable|email|max:255',
        ]);

        $social->update([
            'social_links' => [
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'email_social' => $request->email_social
            ]
        ]);

    return redirect()->back()->with('success', 'Cập nhật social links thành công!');
    }
/* =====================STUDIO==============================*/
    public function editStudio()
    {
        $template = 'admin.company_info.studio';
        $studio = CompanyInfo::firstOrCreate(['type'=>'studio']);
        return view('admin.dashboard.layout', compact('template','studio'));
    }

    public function updateStudio(Request $request)
    {
        $studio = CompanyInfo::firstOrCreate(['type'=>'studio']);

        $request->validate([
            'studio_image'=>'nullable|image|max:2048',
            'studio_content'=>'nullable|string|max:1000',
            'awards'=>'nullable|string|max:5000',
    ]);
        $path_image = $studio->studio_image;
        if ($request->hasFile('studio_image')) {
            $path_image = $request->file('studio_image')->store('companyInfos', 'public');
        }
        $studio->update([
            'studio_content' => $request->studio_content,
            'awards' => array_filter(explode(PHP_EOL, $request->awards)),
            'studio_image' => $path_image
        ]);

        return redirect()->back()->with('success', 'cập nhật thành công');
    }
}