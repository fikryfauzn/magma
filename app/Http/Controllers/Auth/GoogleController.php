<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Find or create the user by email
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'username' => $googleUser->getName(),
                    'password' => bcrypt('google_login'), // Dummy password for Google users
                    'email_verified_at' => now(),
                    'role' => 'customer', // Default role; customize as needed
                ]
            );

            // Log the user in
            Auth::login($user);

            return redirect()->intended('/'); // Redirect to home or intended page
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['login' => 'There was an issue logging in with Google']);
        }
    }
}
