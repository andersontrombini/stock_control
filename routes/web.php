<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\TechnicalController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rotas autenticadas (todos)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Profile (todos)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Área do técnico
    Route::resource('technicals', TechnicalController::class);
});

/*
|--------------------------------------------------------------------------
| Rotas ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', AdminMiddleware::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');

    // Equipments
    Route::resource('equipments', EquipmentController::class)->except(['show']);
    Route::get('/equipments/export', [EquipmentController::class, 'export'])
        ->name('equipments.export');

    // Service Orders
    Route::resource('service_orders', ServiceOrderController::class);
    Route::get(
        '/service-orders/{serviceOrder}/equipments',
        [ServiceOrderController::class, 'equipments']
    )->name('service_orders.equipments');

    Route::get(
        '/service-orders/export',
        [ServiceOrderController::class, 'export']
    )->name('service_orders.export');
});

require __DIR__ . '/auth.php';
