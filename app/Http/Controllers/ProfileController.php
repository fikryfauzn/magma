<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class ProfileController extends Controller
{

    public function show()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Return the profile view with the user data
        return view('profile', compact('user'));
    }

    public function showTransactions()
{
    $transactions = Transaction::with('product')->where('user_id', Auth::id())->get();
    return view('transactions', compact('transactions'));
}

    // Update profile information (excluding password)
    public function update(Request $request)
    {
        $user = Auth::user();

        // Step 1: Validate the input for profile info
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'telephone_number' => 'required|string|max:15',
            'location' => 'required|string|max:255',
        ]);

        // Format the telephone number to start with +62
        $telephoneNumber = $validatedData['telephone_number'];
        if (substr($telephoneNumber, 0, 1) == '0') {
            $telephoneNumber = '+62' . substr($telephoneNumber, 1);
        } elseif (!str_starts_with($telephoneNumber, '+62')) {
            $telephoneNumber = '+62' . $telephoneNumber;
        }

        // Update user information excluding password
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->telephone_number = $telephoneNumber;
        $user->location = $validatedData['location'];

        // Save the user details
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    // Update password only
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Step 1: Validate the password input
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => [
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
            'new_password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.'
        ]);

        // Check if the current password matches
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->route('profile')->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }
}
