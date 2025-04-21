<?php
use Illuminate\Support\Facades\Route;
// -------- User Side Controllers --------
use App\Http\Controllers\User\UserReviewController;
// -------- admin Side Controllers --------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminReviewController;

use App\Http\Controllers\MenuController;

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
// ---------------------------- user Routes ----------------------------
                    // reviews
Route::post('/submit-review', [UserReviewController::class, 'store'])->name('review.store');
Route::get('user/review', [UserReviewController::class, 'index'])->name('user.review.review');
Route::get('/review', [UserReviewController::class, 'showreview']);
// --------------------- Admin Routes ----------------------------
                   // reviews
 Route::get('/admin/review', [AdminReviewController::class, 'index'])->name('admin.review.index');
 Route::get('/admin/review/approve/{id}', [AdminReviewController::class, 'approve'])->name('admin.review.approve');
 Route::get('/admin/review/reject/{id}', [AdminReviewController::class, 'reject'])->name('admin.review.reject');
 Route::delete('/admin/review/delete/{id}', [AdminReviewController::class, 'destroy'])->name('admin.review.delete');
 // ------- Header Section Routes --------
Route::get('/admin/review/header/create', [AdminReviewController::class, 'createHeader'])->name('admin.review.header.create');
Route::post('/admin/review/header/store', [AdminReviewController::class, 'storeHeader'])->name('admin.review.header.store');
Route::get('/admin/review/header/edit/{id}', [AdminReviewController::class, 'editHeader'])->name('admin.review.header.edit');
Route::put('/admin/review/header/update/{id}', [AdminReviewController::class, 'updateHeader'])->name('admin.review.header.update');
Route::delete('/admin/review/header/delete/{id}', [AdminReviewController::class, 'deleteHeader'])->name('admin.review.header.delete');

// ------- Carousel Section Routes --------
Route::get('/admin/review/carousel/create', [AdminReviewController::class, 'createCarousel'])->name('admin.review.carousel.create');
Route::post('/admin/review/carousel/store', [AdminReviewController::class, 'storeCarousel'])->name('admin.review.carousel.store');
Route::get('/admin/review/carousel/edit/{id}', [AdminReviewController::class, 'editCarousel'])->name('admin.review.carousel.edit');
Route::put('/admin/review/carousel/update/{id}', [AdminReviewController::class, 'updateCarousel'])->name('admin.review.carousel.update');
Route::delete('/admin/review/carousel/delete/{id}', [AdminReviewController::class, 'deleteCarousel'])->name('admin.review.carousel.delete');




Route::get('/', [HomeController::class, 'index'])->name('home');
// contact
Route::prefix('contact')->group(function(){
    Route::get('/', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/store',[ContactController::class, 'store'])->name('contact.store');
});

// menu of the day
Route::get('/menu-of-the-day', [MenuController::class, 'showMenu'])->name('menu');




Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
