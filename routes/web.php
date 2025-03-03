<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleDefectController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Users Module
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');
    Route::post('/users/restore/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/force-delete/{id}', [UserController::class, 'forceDelete'])->name('users.forceDelete');

    // Product Module
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{product}', [ProductController::class, 'destroy'])->name('products.delete');

    // Vehicle Type Module
    Route::get('/vehicle_types', [VehicleTypeController::class, 'index'])->name('vehicle_types.index');
    Route::get('/vehicle_types/create', [VehicleTypeController::class, 'create'])->name('vehicle_types.create');
    Route::post('/vehicle_types/store', [VehicleTypeController::class, 'store'])->name('vehicle_types.store');
    Route::get('/vehicle_types/edit/{vehicle_types}', [VehicleTypeController::class, 'edit'])->name('vehicle_types.edit');
    Route::put('/vehicle_types/update/{vehicle_types}', [VehicleTypeController::class, 'update'])->name('vehicle_types.update');
    Route::delete('/vehicle_types/delete/{vehicle_types}', [VehicleTypeController::class, 'destroy'])->name('vehicle_types.delete');

    // Vehicle Module
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles/store', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/edit/{vehicle}', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/update/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/delete/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.delete');

    // Vehicle Defects Module
    Route::get('/vehicle-defects', [VehicleDefectController::class, 'index'])->name('vehicle-defects.index');
    Route::get('/vehicle-defects/create', [VehicleDefectController::class, 'create'])->name('vehicle-defects.create');
    Route::post('/vehicle-defects/store', [VehicleDefectController::class, 'store'])->name('vehicle-defects.store');
    Route::get('/vehicle-defects/edit/{vehicleDefect}', [VehicleDefectController::class, 'edit'])->name('vehicle-defects.edit');
    Route::put('/vehicle-defects/update/{vehicleDefect}', [VehicleDefectController::class, 'update'])->name('vehicle-defects.update');
    Route::delete('/vehicle-defects/delete/{vehicleDefect}', [VehicleDefectController::class, 'destroy'])->name('vehicle-defects.delete');

    Route::resource('countries', CountryController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('locations', LocationController::class);

});
