<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class PortfolioMemberController extends Controller
{
    public function index()
    {
        $members = Member::where('site', 'design')->get();
        return view('sitevicnguyendesign.team', compact('members'));
    }
    
}