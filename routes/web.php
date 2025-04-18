<?php

use App\Http\Controllers\Admin\DashboardController;
use \App\Http\Middleware\UserMiddleware as UserMiddleware;
use \App\Http\Middleware\AdminMiddleware as AdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


// Rout visitor
Route::get('/', function () {
    return view('welcome');
});
Route::get('/blog', function () {
    return view('visitors.Blog');
});
Route::get('/About', function () {
    return view('visitors.About_Us');
});
Route::get('/contact', function () {
    return view('visitors.Contact');
});

Route::post('/contact', function (Request $request) {
    return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
})->name('contact.submit');


// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth', UserMiddleware::class])->group(function () {
});

// Admin routes - fixed the nested middleware and path issue
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('calendar', [App\Http\Controllers\Admin\CalendarController::class, 'getCalendar'])->name('admin.calendar');
});

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

