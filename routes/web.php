<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RepairAgentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Define the resource route, excluding the `show` method
    Route::resource('devices', DeviceController::class)->except(['show']);

    // Custom route for showing devices under repair
    Route::get('/devices/repair', [DeviceController::class, 'showRepairs'])->name('devices.repair');

    Route::resource('repairs', RepairController::class)->except(['show']);

    Route::get('/devices/{device}/repairs', [DeviceController::class, 'viewRepairHistory'])->name('devices.repairs.history');

    Route::get('/repairs/history', [RepairController::class, 'viewAllRepairHistory'])->name('repairs.history');
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/repairs/track', [RepairController::class, 'trackRepairs'])->name('repairs.track');
Route::post('/repairs/track', [RepairController::class, 'searchRepairs'])->name('repairs.search');

Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::put('/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');

Route::post('/repair-agents', [RepairAgentController::class, 'store'])->name('repair-agents.store');
Route::put('/repair-agents/{repairAgent}', [RepairAgentController::class, 'update'])->name('repair-agents.update');
Route::delete('/repair-agents/{repairAgent}', [RepairAgentController::class, 'destroy'])->name('repair-agents.destroy');
Route::get('/repair-agents', [RepairAgentController::class, 'index'])->name('repair-agents.index');

