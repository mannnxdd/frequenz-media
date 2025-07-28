<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard utama (default)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route setelah login
Route::middleware(['auth'])->group(function () {

    /**
     * ======================
     * 🛠️ ADMIN SECTION
     * ======================
     */
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::resource('projects', ProjectController::class);
});
        // CRUD pesanan dan proyek
        Route::resource('orders', OrderController::class);
        Route::resource('projects', ProjectController::class);

        // CRUD user
        Route::resource('admin/users', UserController::class);
        Route::get('admin/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('admin/users', [UserController::class, 'store'])->name('users.store');
        Route::post('/orders/{order}/bukti', [OrderController::class, 'uploadBukti'])->name('orders.uploadBukti');

    });

    /**
     * ======================
     * 🎨 DESIGNER SECTION
     * ======================
     */
    Route::middleware([RoleMiddleware::class . ':designer'])->group(function () {
        Route::get('desain-orders', [OrderController::class, 'designerIndex'])->name('orders.desain');
        Route::post('/orders/{order}/upload', [OrderController::class, 'uploadDesain'])->name('orders.upload');
    });

    /**
     * ======================
     * 📷 FOTOGRAFER SECTION
     * ======================
     */
    Route::middleware([RoleMiddleware::class . ':fotografer'])->group(function () {
        Route::get('foto-orders', [OrderController::class, 'fotograferIndex'])->name('orders.foto');
        Route::patch('/orders/{order}/mark-done', [OrderController::class, 'markAsDone'])->name('orders.done');
    });

    /**
     * ===============================
     * 📣 SOCIAL MEDIA SPECIALIST
     * ===============================
     */
    Route::middleware([RoleMiddleware::class . ':social-media'])->group(function () {
        Route::get('publikasi', [ProjectController::class, 'readyToPublish'])->name('projects.publish');
Route::patch('publikasi/{project}/publish', [ProjectController::class, 'publish'])->name('projects.publish.update');

    });
});

require __DIR__ . '/auth.php';