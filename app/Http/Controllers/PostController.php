<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index(){
        $posts = Post::query()
            ->latest()
            ->paginate();

        return view('pages.posts.index',[
            'posts' => $posts,
        ]);
    }

    function show(Post $post)
    {
        return view('pages.posts.show', [
            'post' => $post
        ]);
    }
}
