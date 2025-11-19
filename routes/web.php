<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TowerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartemenController;
use App\Http\Controllers\Admin\ProsesController;
use App\Http\Controllers\Admin\ApproveController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\NetworkController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\ServerController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\RiwayatPerawatanController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::prefix('admin')->name('admin.')
    ->middleware(['auth','admin','staff.readonly'])
    ->group(function(){
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('tower', TowerController::class);
        Route::resource('vendor', VendorController::class);
        Route::resource('user', UserController::class);
        Route::resource('departemen', DepartemenController::class);
        Route::resource('proses', ProsesController::class);
        Route::resource('approve', ApproveController::class);
        Route::resource('network', NetworkController::class);
        Route::resource('location', LocationController::class);
        Route::resource('lisensi', \App\Http\Controllers\Admin\LisensiController::class);
        Route::resource('sop', \App\Http\Controllers\Admin\SopController::class);
        Route::resource('server', ServerController::class);
        Route::resource('announcement', AnnouncementController::class);
        Route::resource('riwayatperawatan', RiwayatPerawatanController::class);
    });

Auth::routes();