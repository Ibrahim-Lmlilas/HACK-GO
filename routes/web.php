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
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Client\MyBookingsController;
use App\Http\Controllers\Client\ChannelController;
use App\Http\Controllers\NotificationController;

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

    Route::get('/trips', [App\Http\Controllers\Client\TripController::class, 'index'])->name('client.trips.index');
    Route::get('/trips/{trip}', [App\Http\Controllers\Client\TripController::class, 'show'])->name('client.trips.show');
    Route::get('/trips/{trip}/book', [App\Http\Controllers\Client\TripController::class, 'book'])->name('client.trips.book');

    // Add My Bookings route
    Route::get('/my-bookings', [MyBookingsController::class, 'index'])->name('client.bookings.index');

    // Add Channels route
    Route::get('/client/chat', [ChannelController::class, 'index'])->name('client.chat');

    // Add Chat routes
    Route::get('/client/chat/{channel}', [App\Http\Controllers\Client\ChatController::class, 'show'])->name('client.chat.show');
    Route::post('/client/chat/{channel}', [App\Http\Controllers\Client\ChatController::class, 'store'])->name('client.chat.store');
});

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking routes
    Route::post('/trips/{trip}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::get('/booking/{booking}/success', [BookingController::class, 'success'])->name('booking.success');
    Route::put('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
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

    Route::get('trips/{trip}/select-hotel', [AdminTripController::class, 'selectHotel'])->name('admin.trips.select-hotel');
    Route::post('trips/{trip}/save-hotel', [AdminTripController::class, 'saveHotel'])->name('admin.trips.save-hotel');
});

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

// Notification routes
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'getUserNotifications'])->name('notifications.index');
    Route::get('/admin/notifications', [NotificationController::class, 'getAdminNotifications'])->middleware('admin')->name('admin.notifications.index');
    Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
});




