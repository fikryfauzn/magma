<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class ProfileController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->get();

        return view('profile', compact('transactions'));
    }
}
