<?php
use Illuminate\Support\Facades\Route;

// -------- User Side Controllers --------
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\User\ReservationController;
use App\Http\Controllers\User\UserPackageController;
use App\Http\Controllers\User\UserBookingPackageController;
use App\Http\Controllers\User\UserProfileController;


// -------- Admin Side Controllers --------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminBookingPackageController;

// -------- Other Controllers --------
use App\Http\Controllers\ServicesController;

// ---------------------------- Admin Routes ----------------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->name('dashboard');

    // Room Management
    Route::resource('rooms', AdminRoomController::class)->except(['show']);

    // Reservation Management
    Route::prefix('reservations')->name('reservations.')->group(function () {
        Route::get('/', [AdminReservationController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AdminReservationController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AdminReservationController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AdminReservationController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminReservationController::class, 'destroy'])->name('destroy');
    });
});


// pckages
// Packages Routes
// Packages Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/packages', [AdminPackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/edit/{id}', [AdminPackageController::class, 'edit'])->name('packages.edit');
    Route::get('/packages/create', [AdminPackageController::class, 'create'])->name('packages.create');
    Route::post('/packages/store', [AdminPackageController::class, 'store'])->name('package.store');
    Route::put('/packages/update/{id}', [AdminPackageController::class, 'update'])->name('package.update');
    Route::delete('/packages/delete/{id}', [AdminPackageController::class, 'destroy'])->name('package.delete');
});

// Booking Packages Routes
Route::prefix('admin/')->name('admin.bookingspackages.')->group(function () {
    Route::get('/bookingspackages', [AdminBookingPackageController::class, 'index'])->name('index');
    // Route::get('/edit/{id}', [AdminBookingPackageController::class, 'edit'])->name('edit');
    // Route::put('/update/{id}', [AdminBookingPackageController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [AdminBookingPackageController::class, 'destroy'])->name('destroy');
});








// Admin Routes

use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminManagementController;

use App\Http\Controllers\Admin\AdminDashboardController;

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');;

//     Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])->name('register');
//     Route::post('/register', [AdminRegisterController::class, 'register'])->name('register.submit');
    
// });


// // admin profile
// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
//     Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
// });


// // super admin
// use App\Http\Controllers\Admin\AdminManagementController;

// Route::middleware(['auth', 'super_admin'])->group(function () {
//     Route::get('/admin/superadmin', [AdminManagementController::class, 'create'])->name('superadmin.createAdmin');
//     Route::post('/admin/superadmin', [AdminManagementController::class, 'store'])->name('superadmin.storeAdmin');
// });


// Route::middleware(['auth'])->group(function () {
//     Route::get('/admin/superadmin', [AdminManagementController::class, 'index'])->name('admin.register'); // List Admins
//     Route::get('/admin/superadmin', [AdminManagementController::class, 'create'])->name('admin.'); // Add Form
//     Route::post('/admin/superadmin', [AdminManagementController::class, 'store'])->name('admin.users.store'); // Save Admin
// });




// ==========================
// Admin Login (Shared login page for admin + super admin)
// ==========================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    
});

// ==========================
// Admin Routes
// ==========================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
});

// Route::middleware(['auth:admin'])->group(function () {
//     Route::get('/admin/profile', [AdminProfileController::class, 'show'])->name('admin.profile.show');
//     Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
//     Route::put('/admin/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
// });



// ==========================
// Super Admin Routes
// ==========================
Route::prefix('admin/superadmin')->name('admin.superadmin.')->group(function () {
    Route::get('/admins', [AdminManagementController::class, 'index'])->name('list');
    Route::get('/admins/create', [AdminManagementController::class, 'create'])->name('create');
    Route::post('/admins', [AdminManagementController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AdminManagementController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminManagementController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminManagementController::class, 'destroy'])->name('destroy');
});






// ---------------------------- User Side Routes ----------------------------
// Rooms
Route::prefix('rooms')->name('user.rooms.')->group(function () {
    Route::get('/', [UserRoomController::class, 'index'])->name('index');
    Route::get('/show/{id}', [UserRoomController::class, 'show'])->name('show');
    Route::get('/store/{id}', [UserRoomController::class, 'store'])->name('store');

});

// Reservations
Route::prefix('reservations')->name('user.reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    Route::get('/create', [ReservationController::class, 'reservationform'])->name('create');
    Route::post('/store', [ReservationController::class, 'store'])->name('store');
    // Route::get('/{id}', [ReservationController::class, 'show'])->name('show');
    // Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
    // Route::post('/{id}/update', [ReservationController::class, 'update'])->name('update');
    // Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
});

Route::prefix('packages')->name('user.packages.')->group(function () {
    Route::get('/', [UserPackageController::class, 'index'])->name('index');
    // Route::get('/show/{id}', [UserRoomController::class, 'show'])->name('show');
});

Route::post('/book', [UserBookingPackageController::class, 'bookPackage'])->name('user.book.package');




// pofile
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile');
//     Route::post('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
   
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/profile', [ReservationController::class, 'myBookings'])->name('user.profile.show');

});


// ---------------------------- Services Routes ----------------------------
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

// ---------------------------- Packages Route ----------------------------
// Route::get('/packages', [PackageController::class, 'showPackages'])->name('packages');

// Route::get('/packages', [UserPackageController::class, 'index'])->name('user.packages');
// Route::post('/packages/book', [UserBookingPackageController::class, 'bookPackage'])->name('user.book.package');

// ---------------------------- Middleware Routes (Future Use) ----------------------------
// Route::middleware(['admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index']);
//     Route::get('/admin/reservations', [AdminReservationController::class, 'index']);
// });
// Route::middleware(['user'])->group(function () {
//     Route::get('/user/reservations', [ReservationController::class, 'index']);
// });

