<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        /* if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        } */

        /* if (auth()->user()?->username !== 'brnathanlima') {
            abort(Response::HTTP_FORBIDDEN);
        } */

        // method can return a boolean
        // request()->user()?->can('admin');

        // performs full authorization with redirects
        // $this->authorize('admin');

        // return a bool
        // Gate::allows('admin');

        return view('admin.posts.create');
    }

    public function store()
    {
        /* $this->validatePost();

        $attributes['user_id'] = auth()->id();
        $attributes['published_at'] = Carbon::now();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); */

        /* Post::create(array_merge($this->validatePost(), [
            'user_id' =>  auth()->id(),
            'published_at' => Carbon::now(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ])); */

        request()->user()->posts()->create(array_merge($this->validatePost(), [
            'published_at' => Carbon::now(),
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post)
    {
        $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post deleted!');
    }

    protected function validatePost(?Post $post = null)
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('posts', 'slug')->ignore($post)
            ],
            'thumbnail' => $post::exists() ? [
                'image'
            ] : [
                'required',
                'image'
            ],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
            ]
        ]);
    }
}
