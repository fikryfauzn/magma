<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\PHPMailerService;  // Custom PHPMailer service
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // Show the form to request the password reset link
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    // Send the reset link to the user's email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Find the user by email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'No user found with that email address.']);
        }

        // Create a password reset token
        $token = Str::random(60);

        // Save the token to the password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['email' => $user->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        // Create the reset URL
        $resetUrl = route('password.reset', ['token' => $token, 'email' => $user->email]);

        // Send the email using PHPMailer
        $mailService = new PHPMailerService();
        $emailSent = $mailService->sendEmail(
            $user->email,
            'Password Reset Request',
            "You requested a password reset. Click the link below to reset your password: <a href='{$resetUrl}'>Reset Password</a>"
        );

        if ($emailSent) {
            return back()->with('status', 'We have emailed your password reset link!');
        } else {
            return back()->withErrors(['email' => 'Failed to send reset link. Please try again later.']);
        }
    }
}
