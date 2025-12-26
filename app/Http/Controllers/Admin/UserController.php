<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $template = 'admin.user.index';
        $account = User::orderByDesc('created_at')->paginate(10);

        return view('admin.dashboard.layout', compact('template', 'account'));
    }

    public function create()
    {
        $template = 'admin.user.create';
        return view('admin.dashboard.layout', compact('template'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user',
        ]);

        User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'password'          => Hash::make($validated['password']),
            'role'              => $validated['role'],
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Tạo tài khoản thành công');
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

            return redirect()
                ->route('admin.user.index')
                ->with('success', 'Xóa người dùng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa người dùng!');
        }
    }
}
