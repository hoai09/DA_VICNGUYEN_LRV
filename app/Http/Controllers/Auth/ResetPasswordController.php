<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ResetPasswordController extends Controller
{
    
    // Hiển thị form nhập email để lấy lại mật khẩu.
    
    public function showForgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    
    // gửi liên kết đặt lại mật khẩu về email.
    
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($data);

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($data)->withErrors(['email' => __($status)]);
    }

    
    // Hiển thị form đặt lại mật khẩu.
    
    public function showResetPassword(Request $request): View
    {
        return view('auth.reset-password', [
            'token' => $request->route('token') ?? $request->input('token'),
            'email' => $request->input('email'),
        ]);
    }

    
    //lưu mật khẩu mới.
    
    public function resetPassword(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $credentials,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))->withErrors(['email' => __($status)]);
    }
}
