<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        /* DB::listen(function ($query) {
            logger($query->sql);
        }); */

        // $posts = Post::latest()->with('category', 'author')->get();

        $posts = Post::latest()->filter(
                    request()->all()
                )->paginate(6)
                ->withQueryString();

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
