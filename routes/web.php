<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('devices', DeviceController::class);
    Route::resource('repairs', RepairController::class);
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');



