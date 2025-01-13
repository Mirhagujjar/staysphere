<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\PageController;

// Home Route - Set Only One!
Route::get('/', [HotelController::class, 'home'])->name('home');

// Hotel Routes
Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');
Route::get('/hotel/create', [HotelController::class, 'create'])->name('hotel.create');
Route::post('/hotel', [HotelController::class, 'store'])->name('hotel.store');
Route::get('/hotel/{hotel}/edit', [HotelController::class, 'edit'])->name('hotel.edit');
Route::put('/hotel/{hotel}', [HotelController::class, 'update'])->name('hotel.update');
Route::delete('/hotel/{hotel}', [HotelController::class, 'destroy'])->name('hotel.destroy');
Route::get('/rooms', [HotelController::class, 'showRooms'])->name('hotel.rooms');
Route::get('/hotel/{id}', [HotelController::class, 'show'])->name('hotel.show');


// Static Pages
// Route::get('/about', [PageController::class, 'about'])->name('about');
// Route::get('/contact', [PageController::class, 'contact'])->name('contact');
// Route::post('/contact/send', [PageController::class, 'sendContact'])->name('contact.send');

// Route::resource('hotel', HotelController::class);
// Route::get('about', [PageController::class, 'about']);
// Route::get('contact', [PageController::class, 'contact']);


Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services'); // Add this line
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('contact/send', [PageController::class, 'sendContact'])->name('contact.send');
  


// Authentication Routes
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

