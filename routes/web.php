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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PostDashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [PostDashboardController::class, 'store']);
    Route::get('/dashboard/create', [PostDashboardController::class, 'create']);
    Route::get('/dashboard/{post:slug}', [PostDashboardController::class, 'show']);
    Route::get('dashboard/{post:slug}/edit', [PostDashboardController::class, 'edit']); 
    Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
