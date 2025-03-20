<?php




use Illuminate\Support\Facades\Route;


// --------------------collect the othr route files
$routeFiles = ['faiza.php', 'sidra.php', 'fozia.php'];

foreach ($routeFiles as $file) {
    require __DIR__ . '/' . $file;
}

// --------------------------------middle ware------------------------------------------

// Route::middleware(['admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index']);
//     Route::get('/admin/reservations', [AdminReservationController::class, 'index']);
// });

// Route::middleware(['user'])->group(function () {
//     Route::get('/user/reservations', [ReservationController::class, 'index']);
// });








Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
