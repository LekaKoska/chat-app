<?php

use App\Http\Controllers\FriendConnectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::controller(FriendConnectionController::class)->middleware(['auth'])->prefix('friends')->name('friends.request.')->group(function ()
{
    Route::get('/', 'request')->name('show');
    Route::post('/send-request/{receiverId}', 'sendRequest')->name('send');
    Route::get('/incoming-request/{receiverId}', 'incomingRequest')->name('incoming');
    Route::patch('/respond-request/{friendship}/{action}', 'respondRequest')->name('respond');
});


require __DIR__.'/auth.php';
