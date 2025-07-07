<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\EnsureIsOwner;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');
Route::get('/home', HomeController::class)->name('home');
Route::get('/search', SearchController::class)->name('search');
Route::get('/@{username}', ProfileController::class)->name('profile');

Route::middleware('guest')->group(function() {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'store'])->name('login.store');
    Route::get('/register', [RegisteredUserController::class, 'index'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function() {
    Route::get('/home/library', [SessionController::class, 'library'])->name('library');
    Route::get('/home/create', [PostController::class, 'index'])->name('create');
    Route::post('/home/create', [PostController::class, 'store'])->name('create.store');

    Route::middleware(EnsureIsOwner::class)->group(function () {
        Route::get('/@{username}/edit', [SessionController::class, 'edit'])->name('profile.edit');
        Route::patch('/@{username}/edit', [SessionController::class, 'update'])->name('profile.update');
        Route::delete('/@{username}/delete', [SessionController::class, 'delete'])->name('profile.delete');
    
        Route::get('/@{username}/{slug}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::patch('/@{username}/{slug}/edit', [PostController::class, 'update'])->name('post.update');
        Route::delete('/@{username}/{slug}/delete', [PostController::class, 'delete'])->name('post.delete');
    });

    Route::post('/@{username}/{slug}/like', [SessionController::class, 'like'])->name('like');

    Route::post('/@{username}/{slug}/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::patch('/@{username}/{slug}/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/@{username}/{slug}/{comment}', [CommentController::class, 'delete'])->name('comment.delete');

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::get('/@{username}/{slug}', [PostController::class, 'show'])->name('post.show');