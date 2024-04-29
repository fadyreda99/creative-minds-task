<?php

use App\Http\Controllers\Admin\Driver\DriverController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
     Route::middleware('isAdmin')->group(function(){
        Route::view('index', 'admin.index')->name('index');

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('all', [UserController::class, 'index'])->name('index');
            Route::get('create', [UserController::class, 'create'])->name('create');
            Route::post('store', [UserController::class, 'store'])->name('store');
            Route::get('edit/{user_id}', [UserController::class, 'edit'])->name('edit');
            Route::post('update', [UserController::class, 'update'])->name('update');
            Route::delete('update', [UserController::class, 'destroy'])->name('destroy');
        });


        Route::prefix('driver')->name('driver.')->group(function () {
            Route::get('all', [DriverController::class, 'index'])->name('index');
            Route::get('create', [DriverController::class, 'create'])->name('create');
            Route::post('store', [DriverController::class, 'store'])->name('store');
            Route::get('edit/{driver_id}', [DriverController::class, 'edit'])->name('edit');
            Route::post('update', [DriverController::class, 'update'])->name('update');
            Route::delete('update', [DriverController::class, 'destroy'])->name('destroy');
        });


        Route::prefix('notify')->name('notify.')->group(function () {
            Route::get('/', [NotificationController::class, 'index'])->name('index');
            Route::post('push', [NotificationController::class, 'push'])->name('push');
          
        });
    });


    require __DIR__ . '/admin_auth.php';
});



