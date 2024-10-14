<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AdminController;



Auth::routes(['verify' => true]);


Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verify-email');
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Show registration form
Route::get('/register', function () {
    return view('register');
})->name('register.form');

Route::get('/', function () {
    return view('home');
})->name('home');

// Success page route
Route::get('/success', function () {
    return view('success');
})->name('success')->middleware('auth'); // Protect with 'auth' middleware to ensure only logged-in users can access it


Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/create-mechanic', [AdminController::class, 'createMechanicForm'])->name('create.mechanic');
    Route::post('/admin/create-mechanic', [AdminController::class, 'storeMechanic']);
    
    Route::get('/admin/create-admin', [AdminController::class, 'createAdminForm'])->name('create.admin');
    Route::post('/admin/create-admin', [AdminController::class, 'storeAdmin']);
});



// Apply the 'guest' middleware, which prevents access if the user is authenticated
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});



Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('/reset-password/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

