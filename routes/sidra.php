<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// -------- User Side Controllers --------
use App\Http\Controllers\User\UserReviewController;
use App\Http\Controllers\User\HeaderReviewController;


// -------- admin Side Controllers --------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminHeaderReviewController;
use App\Http\Controllers\Admin\SliderController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
// ---------------------------- user Routes ----------------------------
                    // reviews
Route::post('/submit-review', [UserReviewController::class, 'store'])->name('review.store');
Route::get('user/review', [UserReviewController::class, 'index'])->name('user.review.review');
Route::get('/review', [UserReviewController::class, 'showreview']);

                   //homeSlider
Route::get('/', [HomeController::class, 'index'])->name('home');

// --------------------- Admin Routes ----------------------------
                   // reviews
 Route::get('/admin/review', [AdminReviewController::class, 'index'])->name('admin.review.index');
 Route::get('/admin/review/approve/{id}', [AdminReviewController::class, 'approve'])->name('admin.review.approve');
 Route::get('/admin/review/reject/{id}', [AdminReviewController::class, 'reject'])->name('admin.review.reject');
 Route::delete('/admin/review/delete/{id}', [AdminReviewController::class, 'destroy'])->name('admin.review.delete');

 //homeSlider
     Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/sliders', [\App\Http\Controllers\Admin\SliderController::class, 'index'])->name('admin.sliders.index');
    Route::get('/sliders/create', [\App\Http\Controllers\Admin\SliderController::class, 'create'])->name('admin.sliders.create');
    Route::post('/sliders', [\App\Http\Controllers\Admin\SliderController::class, 'store'])->name('admin.sliders.store');
    Route::delete('/sliders/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('admin.sliders.destroy');
    Route::get('/sliders/{id}/edit', [\App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::put('/sliders/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'update'])->name('admin.sliders.update');
});




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
