<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\EventController;



use App\Http\Controllers\Admin\AdminEventController;



Route::get('/events', [EventController::class, 'index'])->name('events');





Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
});
use App\Http\Controllers\Admin\HeroSectionController;

Route::get('/hero-section', [HeroSectionController::class, 'index'])->name('admin.hero.index');
Route::post('/hero-section', [HeroSectionController::class, 'store'])->name('admin.hero.store');
Route::get('/hero-section/edit/{id}', [HeroSectionController::class, 'edit'])->name('admin.hero.edit');
Route::put('/hero-section/update/{id}', [HeroSectionController::class, 'update'])->name('admin.hero.update');



use App\Http\Controllers\User\UserDashboardController;

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');



use App\Http\Controllers\User\UserEventBookingController;

Route::get('/user/event-booking/create', [UserEventBookingController::class, 'create'])->name('user.event-booking.create');
Route::post('/user/event-booking/store', [UserEventBookingController::class, 'store'])->name('user.event-booking.store');

use App\Http\Controllers\Admin\AdminEventBookingController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/event-bookings', [AdminEventBookingController::class, 'index'])->name('admin.event-bookings.index');
    Route::get('/event-bookings/approve/{id}', [AdminEventBookingController::class, 'approve'])->name('admin.event-bookings.approve');
    Route::get('/event-bookings/reject/{id}', [AdminEventBookingController::class, 'reject'])->name('admin.event-bookings.reject');
});




Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/event-bookings', [UserEventBookingController::class, 'index'])->name('event-booking.index');
});

