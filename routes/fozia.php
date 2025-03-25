<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\User\EventController;


// login aur regisration py tum ne kam kya h us py bi ab bi tum ne hi kam krna h
// laready tum ne kam kya howa h is liay dia h tumy


// blogs
Route::prefix('blog')->group(function(){
    Route::get('/', [BlogController::class, 'blog'])->name('blog.blog');
    Route::get('/topRoom', [BlogController::class, 'topRoom'])->name('blog.topRoom');
    Route::get('/chefSpecial', [BlogController::class, 'chefSpecial'])->name('blog.chefSpecial');
    Route::get('/guest', [BlogController::class, 'guest'])->name('blog.guest');
    Route::get('/hosting', [BlogController::class, 'hosting'])->name('blog.hosting');
});

Route::get('/events', [EventsController::class, 'index1'])->name('events');




Route::get('/about', [AboutController::class, 'index'])->name('about');



// Public Routes
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');

// Admin Routes (Protected by Middleware)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/events', AdminEventController::class);
});



Route::get('/admin/events', [AdminEventController::class, 'index1'])->name('admin.event');
Route::get('/admin/events/create', [AdminEventController::class, 'create1'])->name('admin.createEvent');
