<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller         //CONTROLLER FE address + studio + footer
{
    public function index()
    {
        $contactInfo = ContactInfo::where('type', 'contact')->firstOrCreate(['type'=>'contact']);
        return view('sitevicnguyen.address', compact('contactInfo'));
    }
    
    public function indexstudio()
    {
        $studio = ContactInfo::where('type', 'studio')->firstOrCreate(['type'=>'studio']);
        return view('sitevicnguyen.studio', compact('studio'));
    }

}
