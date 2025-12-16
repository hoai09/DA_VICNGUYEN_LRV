<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::where('site', 'VicNguyen')->with('projects')->get();
        return view('sitevicnguyen.member', compact('members'));
    }
    
}
