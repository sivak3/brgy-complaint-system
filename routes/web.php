<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('complaints', ComplaintController::class)
     ->middleware(['auth'])
     ->only(['index', 'create', 'store', 'show']);

require __DIR__.'/auth.php';