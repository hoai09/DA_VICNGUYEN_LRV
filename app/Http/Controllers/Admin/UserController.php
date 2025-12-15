<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){

    }

    public function index(){
        $template = 'admin.user.index';
        return view('admin.dashboard.layout',compact('template'));
    }

    
}