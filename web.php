<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;







Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('customer.dashboard');


Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'AdminHome'])->name('admin.dashboard')->middleware('is_admin');


Route::resource('rooms', RoomController::class);

Route::resource('bookings', BookingController::class);

Route::resource('users', UserController::class);




Route::get('/home/room', [App\Http\Controllers\RoomController::class, 'display'])->name('customer.room');

Route::get('/home', [App\Http\Controllers\RoomController::class, 'display1'])->name('customer.dashboard');


Route::get('/home/booking', [RoomController::class, 'editRecord'])->name('customer.booking');

Route::get('/home/booking', [App\Http\Controllers\BookingController::class, 'MakeBook'])->name('customer.booking');
Route::get('/home/book-record', [App\Http\Controllers\BookingController::class, 'showRecord'])->name('customer.record');
Route::post('/customer/book', [BookingController::class, 'book'])->name('customer.book');
Route::get('/booking/{booking}/edit', [BookingController::class, 'editRecord'])->name('customer.edit-record');
Route::put('/home/book-record', [BookingController::class, 'updateRecord'])->name('customer.record');





// routes/web.php

Route::get('/notifications/markAsRead/{id}', [NotificationController::class, 'markAsRead'])
    ->name('markAsRead');
Route::get('/notifications', [NotificationController::class, 'index'])->name('admin.notification');
Route::get('/admin/home', [NotificationController::class, 'index1'])->name('admin.dashboard');