<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PackageController;

// -------userside links------------------
use App\Http\Controllers\User\UserRoomController;

// -------admin side links------------------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRoomController;


use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


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



// ----------------------------------------user side routes------------------------------

// rooms
Route::get('/rooms', [UserRoomController::class, 'index'])->name('user.rooms.index');
Route::get('/rooms/{id}', [UserRoomController::class, 'show'])->name('user.rooms.show');

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


// Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms');
//  Route::get('/rooms', [RoomsController::class, 'rooms'])->name('hotel.rooms');

Route::get('/events', [EventsController::class, 'index'])->name('events');


// contact
Route::prefix('contact')->group(function(){
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/store',[ContactController::class, 'store'])->name('contact.store');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');


// blogs
Route::prefix('blog')->group(function(){
    Route::get('/', [BlogController::class, 'blog'])->name('blog.blog');
    Route::get('/topRoom', [BlogController::class, 'topRoom'])->name('blog.topRoom');
    Route::get('/chefSpecial', [BlogController::class, 'chefSpecial'])->name('blog.chefSpecial');
    Route::get('/guest', [BlogController::class, 'guest'])->name('blog.guest');
    Route::get('/hosting', [BlogController::class, 'hosting'])->name('blog.hosting');
});

// menu of the day 
Route::get('/menu-of-the-day', [MenuController::class, 'showMenu'])->name('menu');

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


// reviews
Route::get('/reviews', [ReviewsController::class, 'showreviews'])->name('reviews');

// pakages
Route::get('/packages', [PackageController::class, 'showPackages'])->name('packages');




Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
