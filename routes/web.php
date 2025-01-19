<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HotelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('reservations.index'); // List reservations
    Route::get('/create', [ReservationController::class, 'reservationform'])->name('reservations.create'); // Show form
    Route::post('/store', [ReservationController::class, 'store'])->name('reservations.store'); // Store reservation
    Route::get('/{id}', [ReservationController::class, 'show'])->name('reservations.show'); // Show details
    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit'); // Edit form
    Route::post('/{id}/update', [ReservationController::class, 'update'])->name('reservations.update'); // Update reservation
    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy'); // Delete reservation
});


Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
//  Route::get('/rooms', [RoomsController::class, 'rooms'])->name('hotel.rooms');

Route::get('/events', [EventsController::class, 'index'])->name('events');

Route::prefix('contact')->group(function(){
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/store',[ContactController::class, 'store'])->name('contact.store');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');






Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

