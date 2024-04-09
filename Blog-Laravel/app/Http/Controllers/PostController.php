<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Mockery\Generator\Method;

class PostController extends Controller
{
    public function index()
    {
        // dd(request(['search']));
        // dd(request()->only('search'))->when();
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author']))
                ->paginate(6)->withQueryString(),

        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
