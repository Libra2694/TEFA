<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\LaporanKemajuanController;
use App\Http\Controllers\LaporanAkhirController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Auth\LoginController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('dosens', DosenController::class);
        
    });
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('proposals', ProposalController::class);

    Route::resource('proposals', ProposalController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('laporan_kemajuans', LaporanKemajuanController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('laporan_akhirs', LaporanAkhirController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('logbooks', LogbookController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('templates', TemplateController::class)->only(['index', 'create', 'store', 'show']);
    
    // Penelitian routes
    Route::prefix('penelitian')->group(function () {
        Route::get('proposals', [ProposalController::class, 'indexPenelitian'])->name('penelitian.proposals.index');
        Route::get('laporan-kemajuans', [LaporanKemajuanController::class, 'indexPenelitian'])->name('penelitian.laporan_kemajuans.index');
        Route::get('laporan-akhirs', [LaporanAkhirController::class, 'indexPenelitian'])->name('penelitian.laporan_akhirs.index');
    });

    // Pengabdian routes
    Route::prefix('pengabdian')->group(function () {
        Route::get('proposals', [ProposalController::class, 'indexPengabdian'])->name('pengabdian.proposals.index');
        Route::get('laporan-kemajuans', [LaporanKemajuanController::class, 'indexPengabdian'])->name('pengabdian.laporan_kemajuans.index');
        Route::get('laporan-akhirs', [LaporanAkhirController::class, 'indexPengabdian'])->name('pengabdian.laporan_akhirs.index');
    });

    //Destroy
    Route::resource('proposals', ProposalController::class);
    Route::resource('laporan_kemajuans', LaporanKemajuanController::class);
    Route::resource('laporan_akhirs', LaporanAkhirController::class);
    Route::resource('logbooks', LogbookController::class);
    Route::resource('templates', TemplateController::class);

});