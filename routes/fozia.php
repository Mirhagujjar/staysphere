<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\EventController;



use App\Http\Controllers\Admin\AdminEventController;



Route::get('/events', [EventController::class, 'index'])->name('events');

// Admin Hero Section
use App\Http\Controllers\Admin\HeroSectionController;

Route::prefix('admin/hero-section')->controller(App\Http\Controllers\Admin\HeroSectionController::class)->group(function () {
    Route::post('/store', 'store')->name('admin.hero.store');
    Route::get('/delete/{id}', 'destroy')->name('admin.hero.delete');
});

// Admin Experience Cards
Route::prefix('admin/experience')->controller(App\Http\Controllers\Admin\ExperienceCardController::class)->group(function () {
    Route::post('/store', 'store')->name('admin.experience.store');
    Route::get('/delete/{id}', 'destroy')->name('admin.experience.delete');
});

// Admin Events
Route::prefix('admin/event')->controller(App\Http\Controllers\Admin\AdminEventController::class)->group(function () {
    Route::post('/store', 'store')->name('admin.event.store');
    Route::get('/delete/{id}', 'destroy')->name('admin.event.delete');
});

// Admin unified view
Route::get('/admin/events-page', [App\Http\Controllers\Admin\EventPageController::class, 'index'])->name('admin.event.page');


Route::get('/admin/event-content', [App\Http\Controllers\Admin\ContentManageController::class, 'index'])->name('admin.event.content');


use App\Http\Controllers\Admin\PageBuilderController;

// Grouped under admin middleware
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/page-builder', [PageBuilderController::class, 'index'])->name('page.builder'); // show form to add
    Route::post('/page-builder/hero', [PageBuilderController::class, 'storeHero'])->name('page.hero.store');
    Route::post('/page-builder/card', [PageBuilderController::class, 'storeCard'])->name('page.card.store');
    Route::post('/page-builder/event', [PageBuilderController::class, 'storeEvent'])->name('page.event.store');

    Route::get('/page-content', [PageBuilderController::class, 'showContent'])->name('page.content'); // list added items
    Route::delete('/page-content/{type}/{id}', [PageBuilderController::class, 'destroy'])->name('page.content.delete');
});


// Delete & Edit Routes (Already defined earlier, but you can add update too if needed)


// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events.index');
//     Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create');
//     Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store');
//     Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
//     Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('admin.events.update');
//     Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
// });
// use App\Http\Controllers\Admin\HeroSectionController;

// Route::get('/hero-section', [HeroSectionController::class, 'index'])->name('admin.hero.index');
// Route::post('/hero-section', [HeroSectionController::class, 'store'])->name('admin.hero.store');
// Route::get('/hero-section/edit/{id}', [HeroSectionController::class, 'edit'])->name('admin.hero.edit');
// Route::put('/hero-section/update/{id}', [HeroSectionController::class, 'update'])->name('admin.hero.update');


// booking event
use App\Http\Controllers\User\UserDashboardController;

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
// booking user panel package
use App\Http\Controllers\User\UserFormPackageController;

Route::middleware(['auth'])->group(function () {

    Route::get('/user/add-package', [UserFormPackageController::class, 'create'])->name('user.add.package');
    Route::post('/user/book-package', [UserFormPackageController::class, 'store'])->name('user.book.package');
});

    Route::get('/bookings', [UserFormPackageController::class, 'index'])->name('booking.index');



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

// booking services


// Show form page
Route::get('/user/services/add', [App\Http\Controllers\User\ServiceRequestController::class, 'create'])->name('user.services.create');

// Handle form submission
Route::post('/user/services/submit', [App\Http\Controllers\User\ServiceRequestController::class, 'store'])->name('services.submit');


Route::get('/user/services/requests', [App\Http\Controllers\User\ServiceRequestController::class, 'index'])->name('user.services.requests');

// room booking

// use App\Http\Controllers\User\Reservationbookingcontroller;

// Route::middleware(['auth'])->group(function () {
//     // Show reservation form
//     Route::get('/user/reservations/create', [Reservationbookingcontroller::class, 'create'])->name('user.reservations.create');

//     // Handle form submission
//     Route::post('/user/reservations', [Reservationbookingcontroller::class, 'store'])->name('user.reservations.store');
// });

// Route::get('/user/my-reservations', [Reservationbookingcontroller::class, 'index'])->name('user.my_reservations');
