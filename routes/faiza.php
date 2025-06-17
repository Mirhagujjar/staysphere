<?php
use Illuminate\Support\Facades\Route;

// -------- User Side Controllers --------
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\User\ReservationController;
use App\Http\Controllers\User\UserPackageController;
use App\Http\Controllers\User\UserBookingPackageController;
use App\Http\Controllers\User\UserProfileController;
// use App\Http\Controllers\User\AboutUsController;


// -------- Admin Side Controllers --------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminBookingPackageController;
use App\Http\Controllers\Admin\AboutUsController;


// -------- Other Controllers --------
use App\Http\Controllers\ServicesController;


// User routes
Route::get('/about', [App\Http\Controllers\User\AboutUsController::class, 'index'])->name('about');

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    // About Us
    Route::get('/about/preview', [AboutUsController::class, 'show'])->name('admin.about.show');
    Route::get('/about', [AboutUsController::class, 'edit'])->name('admin.about.edit');
    Route::post('/about', [AboutUsController::class, 'update'])->name('admin.about.update');
    
    // Team Members
    Route::get('/about/team', [AboutUsController::class, 'teamIndex'])->name('admin.team.index');
    Route::get('/about/team/create', [AboutUsController::class, 'teamCreate'])->name('admin.about.team.create');
    Route::post('/about/team', [AboutUsController::class, 'teamStore'])->name('admin.team.store');
    Route::get('/about/team/{teamMember}/edit', [AboutUsController::class, 'teamEdit'])->name('admin.team.edit');
    Route::put('/about/team/{teamMember}', [AboutUsController::class, 'teamUpdate'])->name('admin.team.update');
    Route::delete('/about/team/{teamMember}', [AboutUsController::class, 'teamDestroy'])->name('admin.team.destroy');
    
    // FAQs
    Route::get('/about/faq', [AboutUsController::class, 'faqIndex'])->name('admin.about.faq-index');
    Route::get('/about/faq/create', [AboutUsController::class, 'faqCreate'])->name('admin.about.faq.create');
    Route::post('/about/faq', [AboutUsController::class, 'faqStore'])->name('admin.about.faq.store');
    Route::get('/about/faq/{faq}/edit', [AboutUsController::class, 'faqEdit'])->name('admin.about.faq.edit');
    Route::post('/about/faq/{faq}', [AboutUsController::class, 'faqUpdate'])->name('admin.about.faq.update');
    Route::delete('/about/faq/{faq}', [AboutUsController::class, 'faqDestroy'])->name('admin.about.faq.destroy');
});

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

        Route::patch('/{id}/status', [AdminReservationController::class, 'updateStatus'])->name('updateStatus');

        Route::get('/past', [AdminReservationController::class, 'pastReservations'])->name('past');
        Route::delete('/force-delete/{id}', [AdminReservationController::class, 'forceDelete'])->name('forceDelete');


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

    Route::patch('/{id}/toggle-ban', [AdminManagementController::class, 'toggleBan'])->name('toggleBan');

});

















use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\AdminUserController;


// routes/web.php (admin section)
Route::prefix('admin')->group(function() {
    // Filters
    Route::get('/filters', [FilterController::class, 'index'])->name('admin.filters.index');
    Route::get('/filters/create', [FilterController::class, 'create'])->name('admin.filters.create');
    Route::post('/filters', [FilterController::class, 'store'])->name('admin.filters.store');
    Route::get('/filters/{filter}/edit', [FilterController::class, 'edit'])->name('admin.filters.edit');
    Route::put('/filters/{filter}', [FilterController::class, 'update'])->name('admin.filters.update');
    Route::delete('/filters/{filter}', [FilterController::class, 'destroy'])->name('admin.filters.destroy');
    Route::post('/filters/update-order', [FilterController::class, 'updateOrder'])->name('admin.filters.update-order');
    
    // Filter Options
    Route::get('/filters/{filter}/options', [FilterController::class, 'showOptions'])->name('admin.filters.options');
    Route::post('/filters/{filter}/options', [FilterController::class, 'storeOption'])->name('admin.filters.options.store');
    Route::put('/filter-options/{option}', [FilterController::class, 'updateOption'])->name('admin.filters.options.update');
    Route::delete('/filter-options/{option}', [FilterController::class, 'deleteOption'])->name('admin.filters.options.delete');
    Route::post('/filter-options/update-order', [FilterController::class, 'updateOptionOrder'])->name('admin.filters.options.update-order');

    Route::get('/filter-options/{option}/edit', [FilterController::class, 'editOption'])
     ->name('admin.filters.options.edit');
Route::put('/filter-options/{option}', [FilterController::class, 'updateOption'])
     ->name('admin.filters.options.update');
});







Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::post('/admin/users/{id}/ban', [AdminUserController::class, 'toggleBan'])->name('admin.users.ban');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'deleteUser'])->name('admin.users.delete');









// ---------------------------- User Side Routes ----------------------------
// Rooms
Route::prefix('rooms')->name('user.rooms.')->group(function () {
    Route::get('/', [UserRoomController::class, 'index'])->name('index');
    Route::get('/show/{id}', [UserRoomController::class, 'show'])->name('show');
    Route::get('/store/{id}', [UserRoomController::class, 'store'])->name('store');

});

// Reservations
Route::prefix('reservations')->name('user.reservations.')->middleware('auth')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    Route::get('/create', [ReservationController::class, 'reservationform'])->name('create');
    Route::post('/store', [ReservationController::class, 'store'])->name('store');
    Route::get('/{id}', [ReservationController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [ReservationController::class, 'update'])->name('update');
    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');

    // Route::get('/history', [ReservationController::class, 'getHistory'])->name('history');

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

