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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\GoogleController;





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

    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
});



// Apply the 'guest' middleware, which prevents access if the user is authenticated
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('/reset-password/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('catalog');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/products', [ProductController::class, 'store']);


// Static pages for the company
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Resources routes
Route::view('/faq', 'faq')->name('faq');
Route::view('/guide', 'guide')->name('guide');
Route::view('/services', 'services')->name('services');


Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
