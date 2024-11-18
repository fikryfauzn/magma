<?php

namespace App\Http\Controllers;

use App\Mail\PHPMailerService;  // Import the PHPMailerService
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;  // For URL generation
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    protected $mailer;

    // Inject PHPMailerService via the constructor
    public function __construct(PHPMailerService $mailer)
    {
        $this->mailer = $mailer;
    }

    // Show form to create a mechanic
    public function createMechanicForm()
    {
        return view('admin.create-mechanic');
    }

    // Store mechanic data
    public function storeMechanic(Request $request)
    {
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
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.'
        ]);

        // Create the mechanic user and assign role 'mechanic'
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'mechanic',  // Assign mechanic role explicitly here
        ]);

        // Trigger the Registered event for email verification
        event(new Registered($user));

        // Send the email notification with verification
        $this->sendEmailNotification($user);

        return redirect()->route('home')->with('success', 'Mechanic created successfully and verification email sent!');
    }

    // Show form to create an admin
    public function createAdminForm()
    {
        return view('admin.create-admin');
    }

    // Store admin data
    public function storeAdmin(Request $request)
    {
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
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.'
        ]);

        // Create the admin user and assign role 'admin'
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'admin',  // Assign admin role explicitly here
        ]);

        // Trigger the Registered event for email verification
        event(new Registered($user));

        // Send the email notification with verification
        $this->sendEmailNotification($user);

        return redirect()->route('home')->with('success', 'Admin created successfully and verification email sent!');
    }

    // Use PHPMailerService to send email with verification
    private function sendEmailNotification(User $user)
    {
        // Generate the email verification URL
        $verificationUrl = route('verify-email', [
            'id' => $user->getKey(),       // Use getKey() to get the user ID
            'hash' => sha1($user->email)   // Hash the email to create the verification hash
        ]);

        // Email subject and body with verification URL
        $subject = 'Account Created - Please Verify Your Email';
        $body = "Dear {$user->username},<br>Your account has been successfully created. Please verify your email by clicking the link below:<br><a href='{$verificationUrl}'>Verify Email</a>";

        // Use PHPMailerService to send the email
        if (!$this->mailer->sendEmail($user->email, $subject, $body)) {
            return redirect()->back()->with('error', 'Email could not be sent.');
        }
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }
    public function showManages()
    {
        return view('admin.manages');
    }
    public function showManageUser()
    {
        return view('admin.manage_user');  // Menampilkan halaman manage_user.blade.php
    }
    public function showManageProduct()
    {
        return view('admin.manage_product');  // Menampilkan halaman manage_user.blade.php
    }
    public function showManageServices()
    {
        return view('admin.manage_services');  // Menampilkan halaman manage_user.blade.php
    }
    public function showManageServiceBooking()
    {
        return view('admin.manage_service_booking');  // Menampilkan halaman manage_user.blade.php
    }
    
}
