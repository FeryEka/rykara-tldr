<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostDashboardController;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/posts', function () {
    $posts = Post::latest()->filter(request(['search', 'category', 'author']))->paginate(6)->withquerystring();
    return view('posts', ['title' => 'Blog Page', 'posts' => $posts]);
});

Route::get('/tentang', function () {
    return view('about', ['title' => 'Tentang Kami']);
});

Route::get('/kontak', function () {
    return view('contact', ['title' => 'Kontak Kami']);
});

// detail post route using route model binding with slug laravel feature
Route::get('/posts/{post:slug}', function (Post $post) {
    // find post by slug
    return view('post', ['title' => 'Detail Artikel', 'post'=> $post]);
});

Route::get('/dashboard', [PostDashboardController::class, 'index'])
    ->middleware(['auth', 'verified']) 
    ->name('dashboard');

Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show'])
    ->middleware(['auth', 'verified']) 
    ->name('dashboard.post.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
