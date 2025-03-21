<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServicesController;
use App\Http\Controllers\PackageController;



// -------userside links------------------
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\User\ReservationController;

// -------admin side links------------------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminReservationController;




// ------------------------------admin side routes-----------------------------------------
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/rooms/create', [AdminController::class, 'create'])->name('admin.rooms.create');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', AdminRoomController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/rooms/edit/{id}', [AdminRoomController::class, 'edit'])->name('rooms.edit');
    Route::get('/rooms', [AdminRoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [AdminRoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms/store', [AdminRoomController::class, 'store'])->name('rooms.store');
    Route::put('/rooms/update/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/delete/{id}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');
});

// Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('reservations', AdminReservationController::class);
// });


// reservation
// Route::prefix('reservations')->name('admin.reservations.')->group(function () {
//     Route::get('/', [AdminReservationController::class, 'index'])->name('index');
//     Route::get('/create', [AdminReservationController::class, 'reservationform'])->name('create');
//     Route::post('/store', [AdminReservationController::class, 'store'])->name('store');
//     Route::get('/{id}', [AdminReservationController::class, 'show'])->name('show'); 
//     Route::get('/{id}/edit', [AdminReservationController::class, 'edit'])->name('edit');
//     Route::post('/{id}/update', [AdminReservationController::class, 'update'])->name('update');
//     Route::delete('/{id}', [AdminReservationController::class, 'destroy'])->name('destroy');
// });

Route::prefix('admin/reservations')->name('admin.reservations.')->group(function () {
    Route::get('/', [AdminReservationController::class, 'index'])->name('index');
    Route::get('/show/{id}', [AdminReservationController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [AdminReservationController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AdminReservationController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminReservationController::class, 'destroy'])->name('destroy');
});



// ----------------------------------------user side routes------------------------------

// rooms
Route::get('/rooms', [UserRoomController::class, 'index'])->name('user.rooms.index');
Route::get('/rooms/{id}', [UserRoomController::class, 'show'])->name('user.rooms.show');

// reservation
Route::prefix('reservations')->name('user.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('reservations.index'); // List reservations
    Route::get('/create', [ReservationController::class, 'reservationform'])->name('reservations.create'); // Show form
    Route::post('/store', [ReservationController::class, 'store'])->name('reservations.store'); // Store reservation
    Route::get('/{id}', [ReservationController::class, 'show'])->name('reservations.show'); // Show details
    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit'); // Edit form
    Route::post('/{id}/update', [ReservationController::class, 'update'])->name('reservations.update'); // Update reservation
    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy'); // Delete reservation
});


// Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
//  Route::get('/rooms', [RoomsController::class, 'rooms'])->name('hotel.rooms');








// services
Route::prefix('services')->group(function(){
    Route::get('/', [ServicesController::class, 'showServices'])->name('services');
    Route::get('/housekeeping', [ServicesController::class, 'showhousekeepingDetails'])->name('services.housekeeping');
    // Route::get('/Dining', [ServicesController::class, 'showDiningDetails'])->name('services.Dining');
    Route::get('/Fitness', [ServicesController::class, 'showFitnessDetails'])->name('services.Fitness');
    // Route::get('/Conference', [ServicesController::class, 'showConferenceDetails'])->name('services.Conference');
    Route::get('/Security', [ServicesController::class, 'showSecurityDetails'])->name('services.Security');

    // Route::get('/services/{id}', [ServicesController::class, 'showServiceDetails'])->name('services.details');
});




// pakages
Route::get('/packages', [PackageController::class, 'showPackages'])->name('packages');