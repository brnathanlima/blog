<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        /* DB::listen(function ($query) {
            logger($query->sql);
        }); */

        // $posts = Post::latest()->with('category', 'author')->get();

        $posts = Post::latest()->filter(request()->all())->get();

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
