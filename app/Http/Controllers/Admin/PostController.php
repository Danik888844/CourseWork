<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\TagsForPost;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::query()
            ->paginate();

        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('admin.posts.form', [
            'tags' => $this->getTagsForForm()
        ]);
    }

    public function store(PostRequest $request)
    {
        $post = new Post($request->validated());
        $post->tag()->associate($request->tag_id);
        $post->save();

        $this->uploadImage($post,$request);

        return redirect()->route('admin.posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', [
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', [
            'post' => $post,
            'tags' => $this->getTagsForForm(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->validated());
        $post->tag()->associate($request->tag_id);
        $post->save();

        $this->uploadImage($post,$request);

        return redirect()->route('admin.posts.show',$post);
    }

    public function destroy(Post $post)
    {
        $this->removeImage($post);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }

    function deleteImage(Post $post){
        $this->authorize('update',$post);

        $this->removeImage($post);
        $post->update([
            'image_path' => null
        ]);

        return back();
    }

    protected function getTagsForForm(){
        return Tag::query()
            ->orderBy('name')
            ->get();
    }

    protected function uploadImage(Post $post, PostRequest $request){
        if(!$request->hasFile('image'))
            return;

        $path = $request->file('image')->store('public/posts'); // storage/app/public

        if($path == false)
            throw ValidationException::withMessages([
                'image' => 'Sorry, server error. Cannot upload image'
            ]);

        $this->removeImage($post);

        $post->fill([
            'image_path' => $path
        ])->save();
    }

    protected function removeImage(Post $post){
        if(!$post->image_path)
            return;

        \Storage::delete($post->image_path);
    }
}
