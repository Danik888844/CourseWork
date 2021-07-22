<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function show(Tag $tag){
        $posts = Post::query()
            ->where($tag->getForeignKey(),$tag->id)
            ->latest()
            ->paginate();

        return view('pages.posts.index',[
            'posts' => $posts
        ]);
    }
}
