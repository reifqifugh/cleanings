<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoomSizeController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

// Rute untuk user
Route::middleware('auth')->group(function () {
    Route::get('bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('client/home', [HomeController::class, 'userhome'])->name('client.home');
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('history', [HomeController::class, 'history'])->name('client.history');
});

// Rute untuk admin
Route::middleware(['auth'])->group(function () {
    Route::get('admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::put('admin/bookings/{booking}/verify', [BookingController::class, 'verify'])->name('bookings.verify');
    Route::get('admin/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('admin/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('admin/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('admin');

Route::resource('user', UserManagementController::class)->middleware('admin');

Route::resource('categories', CategoryController::class);
Route::resource('room_sizes', RoomSizeController::class);
Route::resource('payment_methods', PaymentMethodController::class);

Route::resource('bookings', BookingController::class);

    Route::get('/search', [BookingController::class, 'search'])->name('bookings.search');
    Route::get('/show/{id}', [BookingController::class, 'show'])->name('bookings.show');
 