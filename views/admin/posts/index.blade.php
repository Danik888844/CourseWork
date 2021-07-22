<x-layouts.admin :title="__('Posts')">

    <style>
        .cope_text {
            overflow: hidden;
            line-height: 20px;
        }
        .cope_text p {
            margin: 0 0 0 0;
        }
        .line-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
    </style>

    <x-slot name="toolbar">
        <a class="btn btn-success" href="{{ route('admin.posts.create') }}">
            {{__('Add post')}}
        </a>
    </x-slot>

    @if($posts->isEmpty())
        <div class="alert alert-secondary">
            {{ __('No post added yet') }}.
            {{ __('Please,') }}
            <a class="alert-link" href="{{ route('admin.posts.create') }}">
                {{__('add one')}}
            </a>
        </div>
    @else

        @foreach($posts as $post)

            <div class="card my-3">

                <div class="card-body d-flex">

                    @if($post->image_path)
                        <div>
                            <img height="70" src="{{ \Storage::url($post->image_path) }}" alt="">
                        </div>
                    @endif

                    <div class="ms-2">
                        <div class="fw-bold card-title">
                            {{ $post->name }}
                        </div>

                        @if($post->description)
                            <div class="cope_text line-clamp">
                                {{ $post->description }}
                            </div>
                        @endif
                    </div>

                </div>

                <div class="card-footer d-flex align-items-center">

                    @if($post->tag)
                        <a class="me-2" href="{{ route('admin.tags.show', $post->tag) }}">
                            <span class="badge bg-secondary">#{{ $post->tag->name }}</span>
                        </a>
                    @endif

                    <small class="text-secondary me-auto">
                        {{ $post->created_at->diffForHumans() }}
                    </small>

                    <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-sm me-2 btn-primary">
                        {{ __('View') }}
                    </a>

                    <form action="{{ route('admin.posts.destroy',$post) }}" method="post">
                        @csrf @method('delete')

                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning">
                                {{ __('Edit') }}
                            </a>

                            <button class="btn btn-danger">
                                {{ __('Delete') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}

    @endif

</x-layouts.admin>
