<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    /* DB::listen(function ($query) {
        logger($query->sql);
    }); */

    // $posts = Post::latest()->with('category', 'author')->get();


    $posts = Post::latest()->get();

    return view('posts', [
        'posts' => $posts,
        'categories' => Category::all()
    ]);
})->name('home');

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
})->name('post')/* ->where('post', '[A-z_\-]+') */;

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        // 'posts' => $category->posts->load(['category', 'author'])
        'posts' => $category->posts,
        'current_category' => $category,
        'categories' => Category::all()
    ]);
})->name('category');

Route::get('/authors/{author:username}', function (User $author) {
    return view('posts', [
        // 'posts' => $author->posts->load(['category', 'author'])
        'posts' => $author->posts,
        'categories' => Category::all()
    ]);
})->name('author');
