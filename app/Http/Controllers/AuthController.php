<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập bằng email
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Sai email hoặc mật khẩu.',
        ])->onlyInput('email');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất.');
    }
    // Hiển thị form đăng ký
public function showRegisterForm()
{
    return view('auth.register');
}

// Xử lý đăng ký
public function register(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:4|confirmed',
    ]);

    $user = \App\Models\User::create([
        'name' => explode('@', $request->email)[0], // đặt tên mặc định từ email
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('home')->with('success', 'Đăng ký tài khoản thành công!');
}
protected function redirectTo($request)
{
    if (! $request->expectsJson()) {
        return route('login');
    }
}


}
