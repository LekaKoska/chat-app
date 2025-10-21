<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendConnectionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
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
    Route::post('/profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('posts.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::controller(FriendConnectionController::class)->middleware(['auth'])->prefix('friends')->name('friends.request.')->group(function ()
{
    Route::get('/', 'all')->name('index');
    Route::get('/add', 'request')->name('show');
    Route::post('/send-request/{receiverId}', 'sendRequest')->name('send');
    Route::get('/incoming-request', 'incomingRequest')->name('incoming');
    Route::patch('/respond-request/{friendship}/{action}', 'respondRequest')->name('respond');
    Route::delete('/delete/{friend}', 'deleteFriend')->name('remove');
});

Route::middleware('auth')->group(function () {

    Route::controller(PostController::class)->prefix('posts')->name('posts.')->group(function () {
        Route::get('search', 'search')->name('search');
        Route::post('{post}/upvote', 'upvote')->name('upvote');
        Route::post('{post}/downvote', 'downvote')->name('downvote');
    });
    Route::resource(name: 'posts', controller:  PostController::class);
});

Route::resource(name: 'comments', controller: CommentController::class)->middleware('auth');


require __DIR__.'/auth.php';
