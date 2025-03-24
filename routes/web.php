<?php

use Illuminate\Support\Facades\Route;


// Rout visitor
Route::get('/', function () {
    return view('welcome');
});
Route::get('/blog', function () {
    return view('visitors.Blog');
});
