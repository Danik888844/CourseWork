<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::query()
            ->paginate(5);

        return view('admin.tags.index',[
            'tags' => $tags
        ]);
    }

    public function create()
    {
        return view('admin.tags.form');
    }

    public function store(TagRequest $request)
    {
        $tag = Tag::query()
            ->create($request->validated());

        return redirect()->route('admin.tags.show', $tag);
    }

    public function show(Tag $tag)
    {
        return view('admin.tags.show', [
            'tag' => $tag
        ]);
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.form',[
            'tag' => $tag
        ]);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        return redirect()->route('admin.tags.show', $tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
