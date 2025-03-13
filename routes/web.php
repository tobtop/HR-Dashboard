<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HrUploadController;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes (ต้อง login ก่อนถึงจะเข้าถึงได้)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');

    // HR Routes
    Route::get('/hr', [App\Http\Controllers\HrController::class, 'index'])->name('hr.index');
    Route::get('/hr/create', [App\Http\Controllers\HrController::class, 'create'])->name('hr.create');
    Route::post('/hr', [App\Http\Controllers\HrController::class, 'store'])->name('hr.store');
    Route::get('/hr/{id}/edit', [App\Http\Controllers\HrController::class, 'edit'])->name('hr.edit');
    Route::put('/hr/{id}', [App\Http\Controllers\HrController::class, 'update'])->name('hr.update');
    Route::delete('/hr/{id}', [App\Http\Controllers\HrController::class, 'destroy'])->name('hr.destroy');
    
    // HR Upload Routes
    Route::get('/hr/upload', [App\Http\Controllers\HrUploadController::class, 'index'])->name('hr.upload');
    Route::post('/hr/upload/employees', [App\Http\Controllers\HrUploadController::class, 'uploadEmployees'])->name('hr.upload.employees');
    Route::post('/hr/upload/performance', [App\Http\Controllers\HrUploadController::class, 'uploadPerformance'])->name('hr.upload.performance');
});

// Redirect /home to /dashboard
Route::redirect('/home', '/dashboard');
