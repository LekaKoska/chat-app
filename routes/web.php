<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendConnectionController;
use App\Http\Controllers\MakeReadNotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyCommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function ()
{
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/',  'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
        Route::post('/avatar', 'avatar')->name('avatar');
        Route::get('/info/{user:name}','info')->name('info');
    });

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('posts.index');
    })->middleware(['signed'])->name('verification.verify');

    Route::controller(FriendConnectionController::class)->prefix('friends')->name('friends.request.')->group(function ()
    {
        Route::get('/', 'all')->name('index');
        Route::get('/add', 'request')->name('show');
        Route::post('/send-request/{receiverId}', 'sendRequest')->name('send');
        Route::get('/incoming-request', 'incomingRequest')->name('incoming');
        Route::patch('/respond-request/{friendship}/{action}', 'respondRequest')->name('respond');
        Route::delete('/delete/{friend}', 'deleteFriend')->name('remove');
    });

        Route::controller(PostController::class)->prefix('posts')->name('posts.')->group(function () {
            Route::get('search', 'search')->name('search');
            Route::post('{post}/upvote', 'upvote')->name('upvote');
            Route::post('{post}/downvote', 'downvote')->name('downvote');
            Route::get('sort-by', 'sort')->name('sort');
        });
        Route::resource(name: 'posts', controller:  PostController::class);

    Route::resource(name: 'comments', controller: CommentController::class);

    Route::resource(name: 'reply', controller: ReplyCommentController::class);

    Route::put('/notification/{id}', [MakeReadNotificationController::class, 'read'])->name('notification.read');

    Route::controller(ChatController::class)->group(function ()
    {
        Route::post('chat', 'sendMessage')->name('chat');
        Route::get('message/{receiverId}','index')->name('chat.form');
    });

});

require __DIR__.'/auth.php';
