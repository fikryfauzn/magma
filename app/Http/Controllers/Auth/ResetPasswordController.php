<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    // Show the form to reset the password
    public function showResetForm($token, $email)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $email]);
    }

    // Handle the password reset
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Find the password reset token in the database
        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset || Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['email' => 'The reset token is invalid or has expired.']);
        }

        // Find the user by email and reset their password
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Delete the password reset token after successful reset
            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect()->route('login')->with('status', 'Your password has been successfully reset.');
        }

        return back()->withErrors(['email' => 'No user found with that email address.']);
    }
}
