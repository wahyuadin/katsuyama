<?php

use App\Http\Controllers\AuthentifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoadingController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\PlaningController;
use App\Http\Controllers\PrintagController;
use App\Http\Middleware\SesiFalse;
use Illuminate\Support\Facades\Route;

Route::middleware([SesiFalse::class])->group(function () {
    Route::get('/', [AuthentifikasiController::class,'login'])->name('login');
    Route::post('/submit', [AuthentifikasiController::class,'loginsubmit'])->name('submit');
});

Route::middleware(['role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/',[DashboardController::class,'dashboardAdmin'])->name('dashboard.admin');
        Route::prefix('planing')->group(function () {
            Route::get('/',[PlaningController::class,'adminPlaning'])->name('planing.admin');
            Route::post('post', [PlaningController::class, 'adminPlaningTambah'])->name('tambah.planing.admin');
            Route::put('edit/{id}', [PlaningController::class, 'adminPlaningEdit'])->name('edit.planing.admin');
            Route::delete('del/{id}', [PlaningController::class, 'adminPlaningHapus'])->name('hapus.planing.admin');
        });
        Route::prefix('loading')->group(function () {
            Route::get('/',[LoadingController::class,'adminLoading'])->name('loading.admin');
            Route::put('edit/{id}', [LoadingController::class,'adminLoadingEdit'])->name('edit.loading.admin');
            Route::delete('del/{id}', [LoadingController::class,'adminLoadingHapus'])->name('hapus.loading.admin');
        });
        Route::prefix('packing')->group(function () {
            Route::get('/',[PackingController::class,'adminPacking'])->name('packing.admin');
            Route::put('edit/{id}', [PackingController::class,'adminPackingEdit'])->name('edit.packing.admin');
            Route::delete('del/{id}', [PackingController::class,'adminpackingHapus'])->name('hapus.packing.admin');
        });
        Route::prefix('print_tag')->group(function () {
            Route::get('/',[PrintagController::class,'adminPrintag'])->name('printag.admin');
        });
        Route::prefix('user')->group(function () {
            Route::get('/', [DashboardController::class, 'dashboardUser'])->name('user.admin');
            Route::post('tambah', [DashboardController::class, 'dashboardUserTambah'])->name('user.admin.tambah');
            Route::put('edit/{id}', [DashboardController::class, 'dashboardUserEdit'])->name('user.admin.edit');
            Route::delete('hapus/{id}', [DashboardController::class, 'dashboardUserHapus'])->name('user.admin.hapus');
        });
        Route::prefix('profile')->group(function () {
            Route::get('/',[DashboardController::class,'dashboardProfile'])->name('profile.admin');
        });
    });
});
Route::get('/logout', [AuthentifikasiController::class,'logout'])->name('logout');

