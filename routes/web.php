<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resident Routes
Route::resource('complaints', ComplaintController::class)
     ->middleware(['auth'])
     ->only(['index', 'create', 'store', 'show']);

Route::resource('feedbacks', FeedbackController::class)
     ->middleware(['auth'])
     ->only(['index', 'create', 'store', 'show']);

Route::resource('messages', MessageController::class)
     ->middleware(['auth'])
     ->only(['index', 'create', 'store', 'show']);

// Notifications
Route::get('/notifications', [NotificationController::class, 'index'])
     ->middleware(['auth'])
     ->name('notifications.index');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/complaints', [AdminController::class, 'complaints'])->name('complaints');
    Route::patch('/complaints/{complaint}/status', [AdminController::class, 'updateStatus'])->name('complaints.status');
    Route::get('/feedbacks', [AdminController::class, 'feedbacks'])->name('feedbacks');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
});

require __DIR__.'/auth.php';