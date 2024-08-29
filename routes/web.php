<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Define the resource route, excluding the `show` method
    Route::resource('devices', DeviceController::class)->except(['show']);

    // Custom route for showing devices under repair
    Route::get('/devices/repair', [DeviceController::class, 'showRepairs'])->name('devices.repair');

    Route::get('/repairs', [RepairController::class, 'index'])->name('repairs.index');

    Route::resource('repairs', RepairController::class);
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

