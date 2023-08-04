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
use App\Http\Controllers\PromotedController;
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
use App\Http\Controllers\ThAjaranController;
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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// front end
Route::group(['middleware' => 'guest'], function () {
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
});


// BACKEND
Auth::routes(); // halaman login dan register
Route::middleware('auth')->group(function () {
    // Route::get('/home', [HomeController::class, 'index'])->name('home');

    // promoted
    Route::get('/promoted', [PromotedController::class, 'index'])->middleware('group_access');
    Route::get('/promoted/show/{kelas?}/{sub_kelas}', [PromotedController::class, 'show'])->middleware('group_access');
    Route::get('/promoted/edit/{kelas?}/{sub_kelas}', [PromotedController::class, 'edit'])->middleware('group_access');
    Route::put('/promoted/update/{id?}', [PromotedController::class, 'update'])->middleware('group_access');
    Route::post('/promoted/store', [PromotedController::class, 'store'])->middleware('group_access');
    Route::get('/promoted/exportPdf/{kelas?}/{subKelas?}/{param?}', [PromotedController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/promoted/exportExcel/{kelas?}/{subKelas?}/{param?}', [PromotedController::class, 'exportExcel'])->middleware('group_access');

    // slideshow
    Route::resource('/slideshow', SlideshowController::class)->middleware('group_access');

    // introduction
    Route::resource('/introduction', IntroductionController::class)->middleware('group_access');

    // latest news
    Route::resource('/latestNews', LatestNewsController::class)->middleware('group_access');

    // activity
    Route::get('/activity/exportExcel', [ActivityController::class, 'exportExcel']);
    Route::get('/activity/exportPdf', [ActivityController::class, 'exportPdf']);
    Route::resource('/activity', ActivityController::class);

    // alumni
    Route::resource('/alumni', AlumniController::class);

    // about
    Route::resource('/about', AboutController::class)->middleware('group_access');
    Route::get('about/remove/{id}', [AboutController::class, 'remove'])->name('about.remove')->middleware('group_access');

    // settings
    Route::resource('/settings', SettingsController::class)->middleware('group_access');

    // banner
    Route::resource('/banner', BannerController::class)->middleware('group_access');

    // guru
    Route::resource('/guru', GuruController::class)->middleware('group_access');

    // notice
    Route::resource('/notice', NoticeController::class)->middleware('group_access');

    // gallery
    Route::resource('/gallery', GalleryController::class)->middleware('group_access');

    // tahun ajaran
    Route::resource('/th_ajaran', ThAjaranController::class)->middleware('group_access');

    // career
    Route::get('/career/exportPdf', [CareerController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/career/exportExcel', [CareerController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/career', CareerController::class)->middleware('group_access');

    // registration
    Route::resource('/registration', RegistrationController::class)->middleware('group_access');

    // mapel
    Route::get('/mapel/exportPdf', [MapelController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/mapel/exportExcel', [MapelController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/mapel', MapelController::class)->middleware('group_access');

    // kelas
    Route::get('/kelas/exportPdf', [KelasController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/kelas/exportExcel', [KelasController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/kelas', KelasController::class)->middleware('group_access');

    // user
    Route::get('/user/exportPdf/{user?}/{status?}', [UserController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/user/exportExcel/{user?}/{status?}', [UserController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/user', UserController::class)->middleware('group_access');

    // spp siswa
    Route::get('/sppSiswa/getPembayaran', [SppSiswaController::class, 'getPembayaran'])->middleware('group_access');
    Route::get('/sppSiswa/cekPembayaran', [SppSiswaController::class, 'cekPembayaran'])->middleware('group_access');
    Route::get('/sppSiswa/show/{id_siswa}', [SppSiswaController::class, 'show'])->middleware('group_access');
    Route::get('/sppSiswa/exportPdf/{kelas?}/{sub_kelas?}', [SppSiswaController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/sppSiswa/exportExcel/{kelas?}/{sub_kelas?}', [SppSiswaController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/sppSiswa', SppSiswaController::class)->middleware('group_access');

    // jabatan
    Route::get('/jabatan/exportPdf', [JabatanController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/jabatan/exportExcel', [JabatanController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/jabatan', JabatanController::class)->middleware('group_access');

    // pembayaran
    Route::get('/pembayaran/exportPdf', [PaymentController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/pembayaran/exportExcel', [PaymentController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/pembayaran', PaymentController::class)->middleware('group_access');

    // schedule 
    Route::get('/schedule/exportPdf/{kelas?}/{hari?}', [ScheduleController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/schedule/exportExcel/{kelas?}/{hari?}', [ScheduleController::class, 'exportExcel'])->middleware('group_access');
    Route::resource('/schedule', ScheduleController::class)->middleware('group_access');

    // default page
    Route::get('/default', [DefaultWebController::class, 'index'])->middleware('group_access');
    Route::get('/default/{edit}', [DefaultWebController::class, 'edit'])->middleware('group_access');
    Route::post('/default/store', [DefaultWebController::class, 'store'])->middleware('group_access');
    Route::put('/default/{id?}', [DefaultWebController::class, 'update'])->middleware('group_access');
    Route::delete('/default/{id?}', [DefaultWebController::class, 'destroy'])->middleware('group_access');

    // rekruitment
    Route::get('/rekruitment/exportExcel', [RekruitmentController::class, 'exportExcel'])->middleware('group_access');
    Route::get('/rekruitment/exportPdf', [RekruitmentController::class, 'exportPdf'])->middleware('group_access');
    Route::get('/rekruitment/{slug?}', [RekruitmentController::class, 'index'])->middleware('group_access');
    Route::post('/rekruitment/prosesCV', [RekruitmentController::class, 'prosesCV'])->middleware('group_access');
    Route::delete('/rekruitment/delete', [RekruitmentController::class, 'deleteCV'])->middleware('group_access');

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/getAgama/{slug?}', [DashboardController::class, 'getAgama']);
    Route::get('/dashboard/getSiswa/', [DashboardController::class, 'getSiswa']);
    Route::get('/dashboard/getKelas/{slug?}', [DashboardController::class, 'getKelas']);

    // profile
    Route::get('/profile/editGuru/{id?}', [ProfileController::class, 'editGuru']);
    Route::get('/profile/editSiswa/{id?}', [ProfileController::class, 'editSiswa']);
    Route::get('/profile/editAdmin/{id?}', [ProfileController::class, 'editAdmin']);
    Route::put('/profile/updateGuru/{id?}', [ProfileController::class, 'updateGuru']);
    Route::put('/profile/updateAdmin/{id?}', [ProfileController::class, 'updateAdmin']);
    Route::put('/profile/updateSiswa/{id?}', [ProfileController::class, 'updateSiswa']);
    Route::resource('/profile', ProfileController::class);

    // evaluation
    Route::get('/evaluation/exportPdf/{user?}', [EvaluationController::class, 'exportPdf']);
    Route::get('/evaluation/exportExcel/{user?}', [EvaluationController::class, 'exportExcel']);
    Route::resource('/evaluation', EvaluationController::class);

    // Siswa
    Route::get('/siswa/getKota', [SiswaController::class, 'getKota']);
    Route::get('/siswa/exportExcel', [SiswaController::class, 'exportExcel']);
    Route::get('/siswa/exportPdf', [SiswaController::class, 'exportPdf']);
    Route::resource('/siswa', SiswaController::class);

    // absensi
    Route::get('/absensi/exportPdf/{kelas?}', [AbsensiController::class, 'exportPdf']);
    Route::get('/absensi/exportExcel/{kelas?}', [AbsensiController::class, 'exportExcel']);
    Route::get('/absensi/exportPdfList/{kelas?}', [AbsensiController::class, 'exportPdfList']);
    Route::get('/absensi/exportExcelList/{kelas?}', [AbsensiController::class, 'exportExcelList']);
    Route::resource('/absensi', AbsensiController::class);
});
