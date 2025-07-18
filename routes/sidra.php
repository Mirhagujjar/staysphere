<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// -------- User Side Controllers --------
use App\Http\Controllers\User\UserReviewController;
use App\Http\Controllers\User\HeaderReviewController;
use App\Http\Controllers\User\UserContactController;


// -------- admin Side Controllers --------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminHeaderReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AdminContactController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;
// ---------------------------- user Routes ----------------------------
                    // reviews
Route::post('/submit-review', [UserReviewController::class, 'store'])->name('review.store');
Route::get('user/review', [UserReviewController::class, 'index'])->middleware('auth')->name('user.review.review');
Route::get('/review', [UserReviewController::class, 'showreview']);

                   //homeSlider
Route::get('/', [HomeController::class, 'index'])->name('home');
//contact
// Route::view('/contact', 'user.contact')->name('user.contact');
Route::post('/contact', [App\Http\Controllers\User\UserContactController::class, 'store'])->name('contact.store');
Route::get('/contact', [App\Http\Controllers\User\UserContactController::class, 'index'])->name('user.contact');








// --------------------- Admin Routes ----------------------------
                   // reviews
Route::group(['middleware' => 'auth'], function () {
 Route::get('/admin/review', [AdminReviewController::class, 'index'])->name('admin.review.index');
 Route::get('/admin/review/approve/{id}', [AdminReviewController::class, 'approve'])->name('admin.review.approve');
 Route::get('/admin/review/reject/{id}', [AdminReviewController::class, 'reject'])->name('admin.review.reject');
 Route::delete('/admin/review/delete/{id}', [AdminReviewController::class, 'destroy'])->name('admin.review.delete');
});
 //homeSlider
     Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/sliders', [\App\Http\Controllers\Admin\SliderController::class, 'index'])->name('admin.sliders.index');
    Route::get('/sliders/create', [\App\Http\Controllers\Admin\SliderController::class, 'create'])->name('admin.sliders.create');
    Route::post('/sliders', [\App\Http\Controllers\Admin\SliderController::class, 'store'])->name('admin.sliders.store');
    Route::delete('/sliders/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'destroy'])->name('admin.sliders.destroy');
    Route::get('/sliders/{id}/edit', [\App\Http\Controllers\Admin\SliderController::class, 'edit'])->name('admin.sliders.edit');
    Route::put('/sliders/{id}', [\App\Http\Controllers\Admin\SliderController::class, 'update'])->name('admin.sliders.update');
});

//contact
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/contact', [App\Http\Controllers\Admin\AdminContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/contact/{id}', [App\Http\Controllers\Admin\AdminContactController::class, 'show'])->name('admin.contact.show');
    Route::delete('/contact/{id}', [App\Http\Controllers\Admin\AdminContactController::class, 'destroy'])->name('admin.contact.destroy');
});
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/contact_settings', [App\Http\Controllers\Admin\ContactPageSettingController::class, 'index'])->name('contact-settings.index');
    Route::get('/contact_settings/create', [App\Http\Controllers\Admin\ContactPageSettingController::class, 'create'])->name('contact-settings.create');
    Route::post('/contact_settings', [App\Http\Controllers\Admin\ContactPageSettingController::class, 'store'])->name('contact-settings.store');
    Route::get('/contact_settings/{id}/edit', [App\Http\Controllers\Admin\ContactPageSettingController::class, 'edit'])->name('contact-settings.edit');
    Route::put('/contact_settings/{id}', [App\Http\Controllers\Admin\ContactPageSettingController::class, 'update'])->name('contact-settings.update');
});


// Route::get('/', [HomeController::class, 'index'])->name('home');
// // contact
// Route::prefix('contact')->group(function(){
//     Route::get('/', [ContactController::class, 'index'])->name('contact.index');
//     Route::post('/store',[ContactController::class, 'store'])->name('contact.store');
// });

// menu of the day
Route::get('/menu-of-the-day', [MenuController::class, 'showMenu'])->name('menu');




Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
