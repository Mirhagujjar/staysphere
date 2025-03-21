<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ContactController;





// contact
Route::prefix('contact')->group(function(){
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/store',[ContactController::class, 'store'])->name('contact.store');
});

// menu of the day 
Route::get('/menu-of-the-day', [MenuController::class, 'showMenu'])->name('menu');

// reviews
Route::get('/reviews', [ReviewsController::class, 'showreviews'])->name('reviews');