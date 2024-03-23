<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KasirDashboardController;
use App\Http\Controllers\ManagerDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsManager;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [GuestController::class, 'index'])->name('welcome');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authentication']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/cari-menu', [KasirDashboardController::class, 'cariMenu']);

Route::middleware('islogin')->group( function () {

    // Route profile
    Route::get('/profile/settings', [ProfileController::class, 'profileIndex'])->name('profile.index');
    Route::post('/profile/settings/update/{id}', [ProfileController::class, 'profileUpdate']);
    Route::get('/profile/change/password', [ProfileController::class, 'changePassIndex'])->name('change.password.index');
    Route::post('/profile/change/password/update', [ProfileController::class, 'changePassUpdate'])->name('change.password.update');
    Route::get('/profile/remove/photo/{id}', [ProfileController::class, 'removePhoto']);

    // Route admin dashboard
    Route::middleware('isadmin')->group( function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'adminIndex'])->name('admin.index');
        Route::get('/admin/dashboard/create', [AdminDashboardController::class, 'adminCreate'])->name('admin.create');
        Route::post('/admin/dashboard/store', [AdminDashboardController::class, 'adminStore'])->name('admin.store');
        Route::get('/admin/dashboard/edit/{id}', [AdminDashboardController::class, 'adminEdit']);
        Route::post('/admin/dashboard/update/{id}', [AdminDashboardController::class, 'adminUpdate']);
        Route::get('/admin/dashboard/delete/{id}', [AdminDashboardController::class, 'adminDelete']);
    });

    // Route manager dashboard
    Route::middleware('ismanager')->group( function () {
        // Menu pages
        Route::get('/manager/dashboard', [ManagerDashboardController::class, 'managerIndex'])->name('manager.index');
        Route::get('/manager/dashboard/create', [ManagerDashboardController::class, 'managerCreate'])->name('manager.create');
        Route::post('/manager/dashboard/store', [ManagerDashboardController::class, 'managerStore'])->name('manager.store');
        Route::get('/manager/dashboard/edit/{id}', [ManagerDashboardController::class, 'managerEdit']);
        Route::post('/manager/dashboard/update/{id}', [ManagerDashboardController::class, 'managerUpdate']);
        Route::get('/manager/dashboard/delete/{id}', [ManagerDashboardController::class, 'managerDelete']);

        // Report pages
        Route::get('/manager/dashboard/report', [ManagerDashboardController::class, 'managerReport'])->name('manager.report');
        Route::get('/manager/dashboard/export-pdf', [ManagerDashboardController::class, 'exportPDF']);
    });

    // Route kasir dashboard
    Route::middleware('iskasir')->group( function () {
        Route::get('/kasir/dashboard', [KasirDashboardController::class, 'kasirIndex'])->name('kasir.index');
        Route::get('/kasir/dashboard/create', [KasirDashboardController::class, 'kasirCreate'])->name('kasir.create');
        Route::post('/kasir/dashboard/store', [KasirDashboardController::class, 'kasirStore'])->name('kasir.store');
        Route::get('/kasir/dashboard/edit/{id}', [KasirDashboardController::class, 'kasirEdit']);
        Route::post('/kasir/dashboard/update/{id}', [KasirDashboardController::class, 'kasirUpdate']);
        Route::get('/kasir/dashboard/delete/{id}', [KasirDashboardController::class, 'kasirDelete']);
    });

});
