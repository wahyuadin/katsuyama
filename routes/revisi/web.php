<?php

use App\Http\Controllers\AuthentifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\UploadController;
use App\Http\Middleware\SesiFalse;
use Illuminate\Support\Facades\Route;

Route::middleware([SesiFalse::class])->group(function () {
    // login
    Route::get('/', [AuthentifikasiController::class,'login'])->name('login');
    Route::post('/submit', [AuthentifikasiController::class,'loginsubmit'])->name('submit');
    // lupa password
    Route::any('/lupa-password', [AuthentifikasiController::class,'lupa_password'])->name('lupa_password');
    Route::any('/reset-password/{token}', [AuthentifikasiController::class,'showResetPasswordForm'])->name('lupa_password.get');
    Route::get('/mahasiswa', [AuthentifikasiController::class,'mahasiswa']);
    Route::get('/mentor', [AuthentifikasiController::class,'mentor']);
});

Route::middleware(['role:mahasiswa'])->group(function () {
    Route::get('dashboard', [DashboardController::class,'mahasiswa'])->name('dashboard.mahasiswa');
    Route::prefix('logbook')->group(function () {
        // Logbook perminggu
        Route::any('weekly', [LogbookController::class,'logbook_bulanan'])->name('logbook.mahasiswa');
        Route::any('pdf', [LogbookController::class, 'pdf'])->name('logbook.pdf');
        // Logbook evaluasi 4 bulan
        Route::any('evaluasi', [LogbookController::class, 'evaluasi'])->name('logbook.evaluasi');
    });
    Route::get('upload', [UploadController::class,'mahasiswa'])->name('upload.mahasiswa');
    Route::get('profile', [DashboardController::class,'mahasiswaProfile'])->name('profile.mahasiswa');
});

Route::middleware(['role:mentor_vokasi'])->group(function () {
    Route::prefix('mentor')->group(function () {
        Route::get('/', [DashboardController::class,'mentor'])->name('dashboard.mentor_vokasi');
        Route::any('logbook', [LogbookController::class,'mentor_logbook'])->name('logbook.mentor');
        Route::any('logbook/reject/{id}', [LogbookController::class,'reject'])->name('logbook.mentor.reject');
        Route::get('profile', [DashboardController::class,'mentorProfile'])->name('profile.mentor');
    });
});

Route::middleware(['role:departemen_head'])->group(function () {
});
Route::get('/logout', [AuthentifikasiController::class,'logout'])->name('logout');


