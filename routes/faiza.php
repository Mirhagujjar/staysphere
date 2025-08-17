<?php
use Illuminate\Support\Facades\Route;

// -------- User Side Controllers --------
use App\Http\Controllers\User\UserRoomController;
use App\Http\Controllers\User\ReservationController;
use App\Http\Controllers\User\UserPackageController;
use App\Http\Controllers\User\UserBookingPackageController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserNotificationController;
use App\Http\Controllers\User\UserServiceController;
use App\Http\Controllers\User\UserServiceRequestController;
// use App\Http\Controllers\User\AboutUsController;
// use App\Http\Controllers\User\BlogController;



// -------- Admin Side Controllers --------
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminPackageController;
use App\Http\Controllers\Admin\AdminBookingPackageController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminManagementController;

use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\ServiceRequestController;



// -------- Other Controllers --------
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\Admin\AdminFacilityController;



// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// *Sub Route*

use Kreait\Firebase\Factory;
use Illuminate\Http\Request;

Route::post('/subscribe-topic', function (Request $request) {
    $validated = $request->validate([
        'token' => 'required|string',
    ]);

    $messaging = (new Factory)
        ->withServiceAccount(base_path('staysphere-6a0b7-firebase-adminsdk-fbsvc-4e9a10beee.json'))
        ->createMessaging();

    try {
        $response[] = $messaging->subscribeToTopic('broadcast', [$validated['token']]);
        $response[] = $messaging->subscribeToTopic('abc', [$validated['token']]);
        return response()->json($response);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});




//user side notifications
Route::get('/notifications', [UserNotificationController::class, 'index'])->name('notifications.index');
Route::delete('/notifications/{id}', [UserNotificationController::class, 'destroy'])->name('notifications.destroy');



//----------------------------------------- gallery---------------------------------

// User side
Route::get('/user/gallery', [GalleryController::class, 'showGallery'])->name('user.gallery');

// Admin side
Route::get('/admin/gallery', [GalleryController::class, 'adminGallery'])->name('admin.gallery');
Route::post('/admin/gallery', [GalleryController::class, 'updateGallery'])->name('admin.gallery.update');
Route::delete('/admin/gallery/delete/{index}', [GalleryController::class, 'deleteGalleryImage'])->name('admin.gallery.delete');


//  ----------------------------------blogs------------------------------------------
// User-facing blog routes
Route::prefix('blog')->name('user.blogs.')->group(function() {
    Route::get('/', [\App\Http\Controllers\User\BlogController::class, 'index'])->name('index');
    Route::get('/search', [\App\Http\Controllers\User\BlogController::class, 'search'])->name('search');
    Route::get('/category/{category}', [\App\Http\Controllers\User\BlogController::class, 'category'])->name('category');
    Route::get('/{blog}', [\App\Http\Controllers\User\BlogController::class, 'show'])->name('show');
    //  Route::get('/gallery', [\App\Http\Controllers\User\BlogController::class, 'showGallery'])->name('gallery');
    // Route::get('/search', [BlogController::class, 'search'])->name('search');

});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function() {
    // Blog Main Page Management
    Route::get('/main', [\App\Http\Controllers\Admin\BlogController::class, 'editMainPage'])->name('blog.main');
    Route::post('/main', [\App\Http\Controllers\Admin\BlogController::class, 'updateMainPage'])->name('blog.main.update');
    // Route::delete('/main/gallery/{index}', [\App\Http\Controllers\Admin\BlogController::class, 'deleteMainGalleryImage'])
    //     ->name('blog.main.delete-image');

    // Regular Blog Posts Management
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    
    // Additional blog routes
    Route::post('blogs/{blog}/toggle-status', [\App\Http\Controllers\Admin\BlogController::class, 'toggleStatus'])
        ->name('blogs.toggle-status');
    // Route::delete('/admin/main/gallery/{index}', [BlogController::class, 'deleteMainGalleryImage'])
    // ->name('admin.main.gallery.delete');        
});


// ---------------------------------------about us--------------------------------
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

// -------------------- Admin controller Routes for rooms and reservation----------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->name('dashboard');
// -----------rooms-----------------
    //Admin Room Management
    Route::resource('rooms', AdminRoomController::class)->except(['show']);

    Route::get('/rooms/{room}/details', [AdminRoomController::class, 'details'])->name('rooms.details');
    Route::post('/rooms/update-hero', [AdminRoomController::class, 'updateHero'])->name('rooms.update-hero');




//---------reservation-------------

    //admin Reservation Management
    Route::prefix('reservations')->name('reservations.')->group(function () {
        // Standard reservation routes
        Route::get('/', [AdminReservationController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AdminReservationController::class, 'show'])->name('show');
        Route::get('/admin/reservations/group/{id}', [AdminReservationController::class, 'groupDetail'])->name('groupdetail');

        Route::get('/{id}/edit', [AdminReservationController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [AdminReservationController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminReservationController::class, 'destroy'])->name('destroy');
        
        // Status management
        // Route::Patch('/{id}/update-status', [AdminReservationController::class, 'updateStatus'])->name('updatestatus');
        Route::patch('/{reservation}/update-status', [AdminReservationController::class, 'updateStatus'])
        ->name('updatestatus');
        Route::get('/{id}/invoice', [AdminReservationController::class, 'invoice'])
        ->name('invoice');
        Route::get('/{id}/invoice/pdf', [AdminReservationController::class, 'downloadInvoice'])->name('invoice.pdf');

        
        // Past reservations
        Route::get('/past', [AdminReservationController::class, 'pastReservations'])->name('past');
        Route::delete('/force-delete/{id}', [AdminReservationController::class, 'forceDelete'])->name('forceDelete');
        
        // Group reservations
        Route::get('/create-group', [AdminReservationController::class, 'createGroup'])->name('create-group');
        Route::post('/create-group', [AdminReservationController::class, 'storeGroup'])->name('store-group');
        
        // Room assignment
        Route::get('/{id}/assign-rooms', [AdminReservationController::class, 'showAssignRooms'])->name('assign-rooms');
        Route::post('/{id}/assign-rooms', [AdminReservationController::class, 'assignRooms'])->name('assign-rooms.store');

        Route::get('/available-rooms/{type}', [AdminReservationController::class, 'availableRooms'])->name('availableRooms');
        Route::patch('/{reservation}/assign-room', [AdminReservationController::class, 'assignRoom'])->name('assignRoom');


        // Route::patch('/{reservation}/update-status', [AdminReservationController::class, 'updateStatus'])
        // ->name('update-status');
    });
});

// ------------------------------admin facilities----------------------------
Route::prefix('facilities')->name('admin.facilities.')->group(function () {
    Route::get('/', [FacilityController::class, 'index'])->name('index');
    Route::get('/create', [FacilityController::class, 'create'])->name('create');
    Route::post('/', [FacilityController::class, 'store'])->name('store');
    Route::get('/{facility}/edit', [FacilityController::class, 'edit'])->name('edit');
    Route::put('/{facility}', [FacilityController::class, 'update'])->name('update');
    Route::delete('/{facility}', [FacilityController::class, 'destroy'])->name('destroy');
    
    // Background image route
    Route::post('/background', [FacilityController::class, 'updateBackground'])
        ->name('background.update');
});

//user side  Rooms routes
Route::prefix('rooms')->name('user.rooms.')->group(function () {
    Route::get('/', [UserRoomController::class, 'index'])->name('index');
    Route::get('/show/{id}', [UserRoomController::class, 'show'])->name('show');
    Route::get('/store/{id}', [UserRoomController::class, 'store'])->name('store');

});

//user side Reservations routes
Route::prefix('reservations')->name('user.reservations.')->middleware('auth')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    Route::get('/create', [ReservationController::class, 'reservationform'])->name('create');
    Route::post('/store', [ReservationController::class, 'store'])->name('store');
    Route::get('/{id}', [ReservationController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [ReservationController::class, 'update'])->name('update');
    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');

    Route::get('/check-availability', [ReservationController::class, 'checkAvailability']);

    Route::get('/{id}/invoice', [ReservationController::class, 'invoice'])
    ->name('invoice');
    Route::get('/{id}/invoice/pdf', [ReservationController::class, 'downloadInvoice'])->name('invoice.pdf');



    // Route::get('/history', [ReservationController::class, 'getHistory'])->name('history');

});

// --------------------------------------------filters----------------------------------
// admin side routes
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


// --------------------------------------services------------------------------------------

// User-facing service routes
Route::prefix('services')->group(function () {
Route::get('/services', [\App\Http\Controllers\User\UserServiceController::class, 'index'])->name('user.services.index');
// web.php
// Route::get('/services/request', [UserServiceController::class, 'create'])->name('services.request');
Route::get('/{slug}', [UserServiceController::class, 'show'])->name('services.show');

Route::post('/services/request', [UserServiceController::class, 'submit'])->name('services.submit');

});




Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('services', AdminServiceController::class)->names('admin.services');
    Route::put('/admin/services/hero-update', [AdminServiceController::class, 'updateHero'])->name('admin.services.hero.update');

    Route::get('/service-requests',[ServiceRequestController::class, 'index'])->name('admin.service_requests.index');
    Route::put('/admin/service-requests/{id}/status', [ServiceRequestController::class, 'updateStatus'])->name('admin.service-requests.updateStatus');
});

Route::get('/my-requests', [UserServiceRequestController::class, 'myRequests'])->name('user.myRequests');


//------------------------------------------ Packages Routes-------------------------------
// admin Packages Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/packages', [AdminPackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/edit/{id}', [AdminPackageController::class, 'edit'])->name('packages.edit');
    Route::get('/packages/create', [AdminPackageController::class, 'create'])->name('packages.create');
    Route::post('/packages/store', [AdminPackageController::class, 'store'])->name('package.store');
    Route::put('/packages/update/{id}', [AdminPackageController::class, 'update'])->name('package.update');
    Route::delete('/packages/delete/{id}', [AdminPackageController::class, 'destroy'])->name('package.delete');
});

// user side packages 
Route::prefix('packages')->name('user.packages.')->group(function () {
    Route::get('/', [UserPackageController::class, 'index'])->name('index');
    // Route::get('/show/{id}', [UserRoomController::class, 'show'])->name('show');
});

Route::post('/book', [UserBookingPackageController::class, 'bookPackage'])->name('user.book.package');

// -----------------------------------booking packages-------------------------------
//admin Booking Packages Routes
Route::prefix('admin/')->name('admin.bookingspackages.')->group(function () {
    Route::get('/bookingspackages', [AdminBookingPackageController::class, 'index'])->name('index');
    // Route::get('/edit/{id}', [AdminBookingPackageController::class, 'edit'])->name('edit');
    // Route::put('/update/{id}', [AdminBookingPackageController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [AdminBookingPackageController::class, 'destroy'])->name('destroy');
});



// ==========================
// Admin Login (Shared login page for admin + super admin)
// ==========================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    
});

//-------------------------  profile Routes-----------------------------------
// admin side routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile.show');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    
     Route::match(['PUT', 'POST'], '/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');
});

// user side  routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('user.profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::match(['PUT', 'POST'], '/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/profile', [ReservationController::class, 'myBookings'])->name('user.profile.show');

});



//----------------------------------- Super Admin manages admins---------------------
// admin side 
Route::prefix('admin/superadmin')->name('admin.superadmin.')->group(function () {
    Route::get('/admins', [AdminManagementController::class, 'index'])->name('list');
    Route::get('/admins/create', [AdminManagementController::class, 'create'])->name('create');
    Route::post('/admins', [AdminManagementController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [AdminManagementController::class, 'edit'])->name('edit');
    Route::put('/{id}', [AdminManagementController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminManagementController::class, 'destroy'])->name('destroy');

    Route::patch('/{id}/toggle-ban', [AdminManagementController::class, 'toggleBan'])->name('toggleBan');

});


// -----------------------------------admin manages users-------------------------------
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::post('/admin/users/{id}/ban', [AdminUserController::class, 'toggleBan'])->name('admin.users.ban');
Route::delete('/admin/users/{id}', [AdminUserController::class, 'deleteUser'])->name('admin.users.delete');


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
