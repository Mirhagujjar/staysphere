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
Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
//  Route::get('/rooms', [RoomsController::class, 'rooms'])->name('hotel.rooms');

Route::get('/events', [EventsController::class, 'index'])->name('events');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about', [AboutController::class, 'index'])->name('about');






Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

