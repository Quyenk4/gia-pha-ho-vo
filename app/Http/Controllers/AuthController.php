<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showLoginForm() { return view('auth.login'); }
    public function login(Request $request) {
        // Nếu bạn muốn mock: redirect to home
        // return redirect()->route('home');
        // Khi làm thật, validate và Auth::attempt...
        $request->validate(['username'=>'required','password'=>'required']);
        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (Auth::attempt([$loginField => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
        return back()->withErrors(['username'=>'Sai tài khoản hoặc mật khẩu'])->onlyInput('username');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
