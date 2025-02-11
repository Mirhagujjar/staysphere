<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\MenuController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HotelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// reservation
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


// contact
Route::prefix('contact')->group(function(){
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/store',[ContactController::class, 'store'])->name('contact.store');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');


// blogs
Route::get('/blogs', [BlogController::class, 'showBlogs'])->name('blogs');

// menu of the day 
Route::get('/menu-of-the-day', [MenuController::class, 'showMenu'])->name('menu');

// services
Route::prefix('services')->group(function(){
    Route::get('/', [ServicesController::class, 'showServices'])->name('services');
    Route::get('/services/{id}', [ServicesController::class, 'showServiceDetails'])->name('services.details');
});


// FAQ
Route::get('/faq', [FAQController::class, 'showFAQ'])->name('faq');



Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

