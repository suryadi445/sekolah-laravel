<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\IntroductionController;
use App\Http\Controllers\LatestController;
use App\Http\Controllers\LatestNewsController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AktifitasController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AlumniKamiController;
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
Route::get('/latest', [LatestController::class, 'index']);
Route::get('/aktifitas', [AktifitasController::class, 'index']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// BACKEND
Route::resource('/slideshow', SlideshowController::class);
Route::resource('/introduction', IntroductionController::class);
Route::resource('/latestNews', LatestNewsController::class);
Route::resource('/activity', ActivityController::class);
Route::resource('/alumni', AlumniController::class);
Route::resource('/alumniKami', AlumniKamiController::class);