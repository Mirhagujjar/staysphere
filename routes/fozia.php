<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventsController;


use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\User\EventController;
use App\Http\Controllers\User\UserAboutUsController;
use App\Http\Controllers\Admin\AdminAboutUsController;




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

// // Admin Routes (Protected by Middleware)
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('/admin/events', AdminEventController::class);
// });



// Route::get('/admin/events', [AdminEventController::class, 'index1'])->name('admin.event');
// Route::get('/admin/events/create', [AdminEventController::class, 'create1'])->name('admin.createEvent');



// Admin Event Management Routes
Route::prefix('admin')->group(function () {
    Route::get('/events', [AdminEventController::class, 'index'])->name('admin.events'); // View all events
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('admin.events.create'); // Show create form
    Route::post('/events', [AdminEventController::class, 'store'])->name('admin.events.store'); // Store new event
    Route::get('/events/{id}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit'); // Show edit form
    Route::put('/events/{id}', [AdminEventController::class, 'update'])->name('admin.events.update'); // Update event
    Route::delete('/events/{id}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy'); // Delete event

});

// about us


// ✅ User Routes
Route::get('/about-us', [UserAboutUsController::class, 'index'])->name('user.about.index');






Route::prefix('admin')->group(function () {
    Route::get('/about-us', [AdminAboutUsController::class, 'index'])->name('admin.about.index');
    Route::get('/about-us/create', [AdminAboutUsController::class, 'create'])->name('admin.about.create');
    Route::post('/about-us', [AdminAboutUsController::class, 'store'])->name('admin.about.store');
    Route::get('/about-us/{id}/edit', [AdminAboutUsController::class, 'edit'])->name('admin.about.edit');
    Route::put('/about-us/update/{id}', [AdminAboutUsController::class, 'update'])->name('admin.about.update');
    Route::delete('/about-us/delete/{id}', [AdminAboutUsController::class, 'destroy'])->name('admin.about.destroy');




});
