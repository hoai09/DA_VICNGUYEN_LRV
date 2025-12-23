<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function index()
    {
        $companyInfo = CompanyInfo::where('type', 'contact')->firstOrCreate(['type'=>'contact']);
        return view('sitevicnguyen.address', compact('companyInfo'));
    }
    
    public function indexstudio()
    {
        $studio = CompanyInfo::where('type', 'studio')->firstOrCreate(['type'=>'studio']);
        return view('sitevicnguyen.studio', compact('studio'));
    }

}
