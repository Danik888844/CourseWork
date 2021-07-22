<x-layouts.admin :title="$post->name">

    <x-slot name="toolbar">

        <a href="{{ route('admin.posts.index') }}" class="btn me-2 btn-primary">
            {{ __('All Posts') }}
        </a>

        <form action="{{ route('admin.posts.destroy',$post) }}" method="post">
            @csrf @method('delete')

            <div class="btn-group">

                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                    {{ __('Edit') }}
                </a>

                <button class="btn btn-danger">
                    {{ __('Delete') }}
                </button>
            </div>

        </form>
    </x-slot>

    <div>
        <span class="views">Views: {{ $post->views }}</span>
    </div>

        <div class="card my-3">
            <div class="card-header">
                {{ __('Tag') }}
            </div>

            <div class="card-body">
                @if($post->tag)
                    <b>Post tag:</b> #{{ $post->tag->name }}
                @else
                    {{ __('Without tag') }}
                @endif
            </div>
        </div>

    @if($post->image_path)
    <div class="card my-3">
        <div class="card-header">
        <img height="250" src="{{ \Storage::url($post->image_path) }}" alt="">
        </div>

        <div class="card-body">
        <form action="{{ route('admin.posts.deleteImage',$post) }}" method="post">
            @csrf @method('delete')
            <button class="btn btn-primary">Delete image</button>
        </form>
        </div>
    </div>
    @endif

    @if($description = trim($post->description))
        <div class="card my-3">
            <div class="card-header">
                {{ __('Description') }}
            </div>
            <div class="card-body">
                {{ $description }}
            </div>
        </div>
    @endif

</x-layouts.admin>
