<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $posts = Post::where('user_id', Auth::id())->latest()->get();
    // $posts = Post::where('user_id', Auth::id())->get();
    return view('home',['posts' => $posts]);
});

// User authentication routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

// Post creation route
Route::post('/create-post', [PostController::class, 'createPost']);

// Edit post routes
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->name('edit-post');
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'])->name('update-post'); // Changed name here
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->name('delete-post'); // Changed name here
