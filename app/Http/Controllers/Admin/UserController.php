<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'email_verified_at' => now(),
    ]);

    return redirect()->route('admin.user.index')->with('success','Tạo tài khoản thành công');
}

public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            if ($user->id === Auth::id()) {
                return redirect()->back()->with('error', 'Không thể xóa tài khoản của chính bạn!');
            }
            
            if ($user->role === 'admin') {
                $adminCount = User::where('role', 'admin')->count();
                if ($adminCount <= 1) {
                    return redirect()->back()->with('error', 'Không thể xóa admin cuối cùng trong hệ thống!');
                }
            }
            
            $user->delete();
            
            return redirect()->route('admin.user.index')->with('success', 'Xóa người dùng thành công!');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa người dùng!');
        }
    }


}


