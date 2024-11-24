<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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

            // Set a cookie to remember the user's login session for 7 days
            $cookie = cookie('remember_user', Auth::user()->id, 60 * 24 * 7); // Cookie expires in 7 days

            // Redirect to home page with the cookie set
            return redirect()->route('home')->withCookie($cookie);
        } else {
            return back()->withErrors(['login' => 'Invalid email/username or password.']);
        }
    }

    public function logout()
    {
        // Log out the user
        Auth::logout();

        // Forget the 'remember_user' cookie
        Cookie::queue(Cookie::forget('remember_user'));

        // Redirect to home page after logout
        return redirect()->route('home');
    }
}
