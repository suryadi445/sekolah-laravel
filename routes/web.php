<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// front end
Route::get('/', [BerandaController::class, 'index']);
Route::get('/about', function () {
    return view('frontend.about');
});
Route::get('/source/{slug}', function () {
    return view('frontend.source');
});

Route::get('/pengumuman', function () {
    return view('frontend.pengumuman');
});

Route::get('/gallery', function () {
    return view('frontend.gallery');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');