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
use App\Http\Controllers\FotoController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\RekruitmentController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\SppSiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// front end
Route::get('/', [BerandaController::class, 'index']);
Route::get('/tentangKami/{slug?}', [TentangKamiController::class, 'index']);
Route::get('/tentangKami/getPosisi/{slug?}', [TentangKamiController::class, 'getPosisi']);
Route::get('/tentangKami/getPosisi_row/{slug?}', [TentangKamiController::class, 'getPosisi_row']);
Route::post('/tentangKami/karir', [TentangKamiController::class, 'karir']);
Route::get('/source/{slug?}', [SourceController::class, 'index']);
Route::get('/source/get_guru/{id}', [SourceController::class, 'get_guru']);
Route::get('/pengumuman', [PengumumanController::class, 'index']);
Route::get('/foto', [FotoController::class, 'index']);
Route::get('/foto/get_image/{id?}', [FotoController::class, 'get_image']);
Route::get('/latest/{id?}', [LatestController::class, 'index']);
Route::get('/latest/get_row/{id}', [LatestController::class, 'get_row']);
Route::get('/aktifitas', [AktifitasController::class, 'index']);
Route::get('/alumniKami/{angkatan?}', [AlumniKamiController::class, 'index']);
Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::post('/pendaftaran/store', [PendaftaranController::class, 'store']);


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
Route::get('/siswa/getKota', [SiswaController::class, 'getKota']);
Route::resource('/siswa', SiswaController::class);

Route::resource('/absensi', AbsensiController::class);
Route::resource('/guru', GuruController::class);
Route::resource('/notice', NoticeController::class);
Route::resource('/gallery', GalleryController::class);
Route::resource('/career', CareerController::class);
Route::resource('/registration', RegistrationController::class);
Route::resource('/mapel', MapelController::class);
Route::resource('/kelas', KelasController::class);
Route::resource('/user', UserController::class);
Route::resource('/evaluation', EvaluationController::class);
Route::resource('/sppSiswa', SppSiswaController::class);
Route::get('/sppSiswa/show/{id_siswa}', [SppSiswaController::class, 'show']);
Route::resource('/jabatan', JabatanController::class);
Route::resource('/pembayaran', PembayaranController::class);

Route::get('/default', [DefaultWebController::class, 'index']);
Route::get('/default/{edit}', [DefaultWebController::class, 'edit']);
Route::post('/default/store', [DefaultWebController::class, 'store']);
Route::put('/default/{id?}', [DefaultWebController::class, 'update']);
Route::delete('/default/{id?}', [DefaultWebController::class, 'destroy']);

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/dashboard/getAgama/{slug?}', [DashboardController::class, 'getAgama']);
Route::get('/dashboard/getSiswa/', [DashboardController::class, 'getSiswa']);
Route::get('/dashboard/getKelas/{slug?}', [DashboardController::class, 'getKelas']);

Route::get('/rekruitment/{slug?}', [RekruitmentController::class, 'index']);
Route::post('/rekruitment/prosesCV', [RekruitmentController::class, 'prosesCV']);
Route::delete('/rekruitment/delete', [RekruitmentController::class, 'deleteCV']);