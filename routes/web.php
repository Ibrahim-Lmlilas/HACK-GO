<?php

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
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

});

