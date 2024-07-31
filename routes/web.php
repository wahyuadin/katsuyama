<?php

use App\Http\Controllers\AuthentifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HanggerController;
use App\Http\Controllers\LoadingController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\PlaningController;
use App\Http\Controllers\PrintagController;
use App\Http\Controllers\ReportController;
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
            Route::put('{id}', [LoadingController::class,'adminLoadingEdit'])->name('edit.loading.admin');
            Route::delete('{id}', [LoadingController::class,'adminLoadingHapus'])->name('hapus.loading.admin');
        });
        Route::prefix('packing')->group(function () {
            Route::get('/',[PackingController::class,'adminPacking'])->name('packing.admin');
            Route::put('edit/{id}', [PackingController::class,'adminPackingEdit'])->name('edit.packing.admin');
            Route::delete('del/{id}', [PackingController::class,'adminpackingHapus'])->name('hapus.packing.admin');
        });
        Route::prefix('report')->group(function () {
            Route::get('/',[ReportController::class,'adminReport'])->name('report.admin');
        });
        Route::prefix('user')->group(function () {
            Route::get('/', [DashboardController::class, 'dashboardUser'])->name('user.admin');
            Route::post('tambah', [DashboardController::class, 'dashboardUserTambah'])->name('user.admin.tambah');
            Route::put('edit/{id}', [DashboardController::class, 'dashboardUserEdit'])->name('user.admin.edit');
            Route::delete('hapus/{id}', [DashboardController::class, 'dashboardUserHapus'])->name('user.admin.hapus');
        });
        Route::prefix('profile')->group(function () {
            Route::get('/',[DashboardController::class,'dashboardProfile'])->name('profile.admin');
            Route::put('{id}', [DashboardController::class, 'dashboardProfilePut'])->name('profile.admin.put');
        });
    });
});
Route::middleware(['role:loading'])->group(function () {
    Route::prefix('operator_loading')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboardLoading'])->name('dashboard.loading');
        Route::prefix('planing')->group(function () {
            Route::get('/',[PlaningController::class,'loadingPlaning'])->name('planing.loading');
        });
        Route::prefix('data')->group(function () {
            Route::get('/',[LoadingController::class,'OperatorLoading'])->name('operator.loading');
            Route::post('/', [LoadingController::class, 'OperatorLoadingTambah'])->name('operator.loading.tambah');
            Route::put('{id}', [LoadingController::class, 'OperatorLoadingEdit'])->name('operator.loading.edit');
            Route::delete('{id}', [LoadingController::class, 'OperatorLoadingHapus'])->name('hapus.loading');
        });
        Route::prefix('hanger')->group(function () {
            Route::get('/',[HanggerController::class,'OperatorLoadingHanger'])->name('operator.loading.hanger');
            Route::post('/', [HanggerController::class, 'OperatorLoadingHangerTambah'])->name('operator.loading.hanger.tambah');
            Route::put('{id}', [HanggerController::class, 'OperatorLoadingHangerEdit'])->name('operator.loading.hanger.edit');
            Route::delete('{id}', [HanggerController::class, 'OperatorLoadingHangerHapus'])->name('operator.loading.hanger.hapus');
        });
        Route::prefix('print_tag')->group(function () {
            Route::get('/',[PrintagController::class,'loadingPrintag'])->name('printag.loading');
            Route::put('{id}', [PrintagController::class, 'loadingPrintagEdit'])->name('operator.loading.printag.edit');
            Route::delete('{id}', [PrintagController::class, 'loadingPrintagHapus'])->name('operator.loading.printag.hapus');
        });
        Route::prefix('report')->group(function () {
            Route::get('/',[ReportController::class,'LoadingReport'])->name('report.loading');
        });
        Route::prefix('profile')->group(function () {
           Route::get('/', [DashboardController::class, 'ProfileLoading'])->name('profile.loading');
           Route::put('{id}', [DashboardController::class, 'dashboardProfilePut'])->name('profile.loading.put');
        });
    });
});
Route::middleware(['role:packing'])->group(function () {
    Route::prefix('operator_packing')->group(function () {
       Route::get('/', [DashboardController::class, 'dashboardPacking'])->name('dashboard.packing');
       Route::get('planing',[PlaningController::class,'loadingPacking'])->name('planing.packing');
       Route::get('loading',[LoadingController::class,'loadingPacking'])->name('loading.packing');
       Route::prefix('data')->group(function () {
            Route::get('/', [PackingController::class, 'OperatorPacking'])->name('operator.packing');
            Route::post('/', [PackingController::class, 'OperatorPackingTambah'])->name('operator.packing.tambah');
            Route::put('{id}', [PackingController::class, 'OperatorPackingEdit'])->name('operator.packing.edit');
            Route::delete('{id}', [PackingController::class, 'OperatorPackingHapus'])->name('operator.packing.hapus');
       });
       Route::prefix('print_tag')->group(function () {
            Route::get('/', [PrintagController::class, 'packingPrintag'])->name('printag.packing');
            Route::put('{id}', [PrintagController::class, 'packingPrintagEdit'])->name('operator.packing.printag.edit');
            Route::delete('{id}', [PrintagController::class, 'packingPrintagHapus'])->name('operator.packing.printag.hapus');
       });
       Route::prefix('report')->group(function () {
            Route::get('/', [ReportController::class,'PackingReport'])->name('report.packing');
       });
       Route::prefix('profile')->group(function () {
            Route::get('/', [DashboardController::class, 'ProfilePacking'])->name('profile.packing');
            Route::put('{id}', [DashboardController::class, 'dashboardProfilePut'])->name('profile.packing.put');
        });
    });
});
Route::get('/logout', [AuthentifikasiController::class,'logout'])->name('logout');

