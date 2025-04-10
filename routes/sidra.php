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
Route::get('/review', [UserReviewController::class, 'index'])->name('user.review.review');
// --------------------- Admin Routes ----------------------------
                   // reviews
 Route::get('/admin/review', [AdminReviewController::class, 'index'])->name('admin.review.index');
 Route::get('/admin/review/approve/{id}', [AdminReviewController::class, 'approve'])->name('admin.review.approve');
 Route::get('/admin/review/reject/{id}', [AdminReviewController::class, 'reject'])->name('admin.review.reject');
 Route::delete('/admin/review/delete/{id}', [AdminReviewController::class, 'destroy'])->name('admin.review.delete');



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
