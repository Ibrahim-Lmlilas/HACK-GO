<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DestinationController;
use \App\Http\Middleware\UserMiddleware as UserMiddleware;
use \App\Http\Middleware\AdminMiddleware as AdminMiddleware;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;
use App\Http\Controllers\Admin\TripController as AdminTripController;

// Rout visitor
Route::get('/', [DestinationController::class, 'index'])->name('welcome');
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
    Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
});

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('calendar', [CalendarController::class, 'getCalendar'])->name('admin.calendar');

    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::resource('trips', AdminTripController::class)->names([
        'index' => 'admin.trips',
        'create' => 'admin.trips.create',
        'store' => 'admin.trips.store',
        'show' => 'admin.trips.show',
        'edit' => 'admin.trips.edit',
        'update' => 'admin.trips.update',
        'destroy' => 'admin.trips.destroy',
    ]);

    // Add routes for hotel selection after trip creation
    Route::get('trips/{trip}/select-hotel', [AdminTripController::class, 'selectHotel'])->name('admin.trips.select-hotel');
    Route::post('trips/{trip}/save-hotel', [AdminTripController::class, 'saveHotel'])->name('admin.trips.save-hotel');
});

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

// Client Routes
Route::get('/api/destinations/{id}', [DestinationController::class, 'show']);
Route::get('/api/hotels', [\App\Http\Controllers\HotelController::class, 'getByCity']);


