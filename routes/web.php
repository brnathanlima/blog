<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post')/* ->where('post', '[A-z_\-]+') */;

Route::post('/posts/{post:slug}/comments', [PostCommentController::class, 'store']);

Route::get('register', [RegisterController::class, 'form'])->middleware('guest')->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.store');

Route::get('/login', [LoginController::class, 'form'])->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');

Route::post('logout', LogoutController::class)->middleware('auth');

Route::post('/newsletter', NewsletterController::class);

/* Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        // 'posts' => $category->posts->load(['category', 'author'])
        'posts' => $category->posts,
        'current_category' => $category,
    ]);
})->name('category'); */

/* Route::get('/authors/{author:username}', function (User $author) {
    return view('posts.index', [
        // 'posts' => $author->posts->load(['category', 'author'])
        'posts' => $author->posts
    ]);
})->name('author'); */
