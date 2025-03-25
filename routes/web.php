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

