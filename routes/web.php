<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;


Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');
Route::get('/hotel/create', [HotelController::class, 'create'])->name('hotel.create');
Route::post('/hotel', [HotelController::class, 'store'])->name('hotel.store');
Route::get('/hotel/{hotel}/edit', [HotelController::class, 'edit'])->name('hotel.edit');
Route::put('/hotel/{hotel}', [HotelController::class, 'update'])->name('hotel.update');
Route::delete('/hotel/{hotel}', [HotelController::class, 'destroy'])->name('hotel.destroy');
Route::get('/rooms', [HotelController::class, 'showRooms'])->name('hotel.rooms');


// Route::get('/', [HomeController::class, 'index']);  // This will show the homepage without requiring login

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});   

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [HomeController::class, 'index']);  // Use this route to handle the homepage




