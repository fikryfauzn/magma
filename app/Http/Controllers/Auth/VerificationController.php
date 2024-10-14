<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify($id, $hash)
    {
        $user = User::findOrFail($id);

        // Check if the hash matches the user's email hash
        if (sha1($user->email) == $hash) {
            $user->email_verified_at = now();
            $user->save();

            return redirect()->route('home')->with('success', 'Email verified successfully.');
        }

        return redirect()->route('home')->with('error', 'Invalid verification link.');
    }
}
