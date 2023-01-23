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
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DefaultWebController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SourceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// front end
Route::get('/', [BerandaController::class, 'index']);
Route::get('/tentangKami/{slug?}', [TentangKamiController::class, 'index']);
Route::get('/source/{slug?}', [SourceController::class, 'index']);
Route::get('/source/get_guru/{id}', [SourceController::class, 'get_guru']);

Route::get('/pengumuman', function () {
    return view('frontend.pengumuman');
});
Route::get('/gallery', function () {
    return view('frontend.gallery');
});
Route::get('/latest/{id?}', [LatestController::class, 'index']);
Route::get('/latest/get_row/{id}', [LatestController::class, 'get_row']);
Route::get('/aktifitas', [AktifitasController::class, 'index']);
Route::get('/alumniKami/{angkatan?}', [AlumniKamiController::class, 'index']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// BACKEND
Route::resource('/slideshow', SlideshowController::class);
Route::resource('/introduction', IntroductionController::class);
Route::resource('/latestNews', LatestNewsController::class);
Route::resource('/activity', ActivityController::class);
Route::resource('/alumni', AlumniController::class);
Route::resource('/about', AboutController::class);
Route::get('about/remove/{id}', [AboutController::class, 'remove'])->name('about.remove');
Route::resource('/settings', SettingsController::class);
Route::resource('/banner', BannerController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/guru', GuruController::class);

Route::get('/default', [DefaultWebController::class, 'index']);
Route::get('/default/{edit}', [DefaultWebController::class, 'edit']);
Route::post('/default/store', [DefaultWebController::class, 'store']);
Route::put('/default/{id?}', [DefaultWebController::class, 'update']);
Route::delete('/default/{id?}', [DefaultWebController::class, 'destroy']);