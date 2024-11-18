<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {
            if (Auth::user()->email_verified_at === null) {
                Auth::logout();
                return back()->withErrors(['login' => 'Your email address is not verified. Please check your inbox.']);
            }

            // Regenerate session ID to prevent session fixation
            session()->regenerate();

            // Logika redirect berdasarkan role langsung di sini
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        } else {
            return back()->withErrors(['login' => 'Invalid email/username or password.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session to ensure it's fully terminated
        $request->session()->invalidate();

        // Regenerate session token to prevent CSRF attacks
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
