<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        // $this->middleware('is_admin');
    }

    public function index(){
        $template = 'admin.user.index';
        $account = User::latest()->paginate(10);
        return view('admin.dashboard.layout',compact('template','account'));
    }

    public function create(){
        $template = 'admin.user.create';
        return view('admin.dashboard.layout',compact('template'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,user',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('admin.user.index')->with('success','Tạo tài khoản thành công');
}

}