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
use App\Http\Controllers\GuideController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;







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

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

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
Route::get('/guide', [GuideController::class, 'index'])->name('guide');


Route::get('/products/grove', [ProductController::class, 'show'])->name('products.grove');
Route::get('/products/jove', [ProductController::class, 'show'])->name('products.jove');
Route::get('/products/move', [ProductController::class, 'show'])->name('products.move');


Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');



// Profile page
Route::middleware('auth')->get('/profile', [ProfileController::class, 'index'])->name('profile.index');

// Edit profile (you'll need a form for this)
Route::middleware('auth')->get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// Order history page
Route::middleware('auth')->get('/orders', [OrderController::class, 'index'])->name('orders.index');

// View specific order details
Route::middleware('auth')->get('/orders/{transactionId}', [OrderController::class, 'show'])->name('orders.show');

// Logout route (default provided by Laravel Auth)
Route::post('/logout', [Auth\LoginController::class, 'logout'])->name('logout');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/products', [ProductController::class, 'store']);


// Routes for Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/payment/{transactionId}', [CheckoutController::class, 'paymentPage'])->name('checkout.payment');
Route::post('/checkout/confirm/{transactionId}', [CheckoutController::class, 'confirmPayment'])->name('checkout.confirm');

Route::middleware('auth')->group(function () {
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::get('/products/jove', function () {
    return view('products.jove');
})->name('products.jove');

Route::get('/products/move', function () {
    return view('products.move');
})->name('products.move');


// Static pages for the company
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Resources routes
Route::view('/faq', 'faq')->name('faq');
Route::view('/services', 'services')->name('services');


Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');
