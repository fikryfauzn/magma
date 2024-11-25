<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\PHPMailerService;

class RegisterController extends Controller
{
    public function registerForm()
    {
        // Render the custom registration form
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Step 1: Validate the request data
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',      // Uppercase
                'regex:/[a-z]/',      // Lowercase
                'regex:/[0-9]/',      // Number
                'regex:/[@$!%*?&]/',  // Special character
                'confirmed'
            ],
            'name' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:15',
            'role' => 'customer',  // Assign 'customer' role by default
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.'
        ]);

        // Step 2: Create the user account
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'name' => $validatedData['name'],
            'telephone_number' => $validatedData['telephone_number'],
            'role' => 'customer',
        ]);

        // Ensure user is saved and ID is available before generating the email
        if (!$user || !$user->getKey()) {
            return redirect()->back()->with('error', 'Failed to create user. Please try again.');
        }

        // Step 3: Send the verification email using PHPMailer
        $mailService = new PHPMailerService();
        $verificationUrl = route('verify-email', [
            'id' => $user->getKey(),       // Use getKey() to get the user ID
            'hash' => sha1($user->email)   // Hash the email to create the verification hash
        ]);

        $emailSent = $mailService->sendEmail(
            $validatedData['email'],
            'Verify Your Email Address',
            "Please verify your email by clicking the following link: <a href='{$verificationUrl}'>Verify Email</a>"
        );

        // Log the user in
        Auth::login($user);

        // Redirect to a page asking the user to verify their email
        if ($emailSent) {
            return redirect()->route('home')->with('success', 'Registration successful. Please check your email for the verification link.');
        } else {
            return redirect()->route('home')->with('error', 'Failed to send verification email. Please try again.');
        }
    }
}
