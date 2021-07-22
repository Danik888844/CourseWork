
<x-layouts.app :title="__('Posts')" :showTags="true">

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
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>

    @if($posts->isEmpty())
        <div class="alert alert-secondary">
            {{ __('There is no posts') }}
        </div>
    @else

        <form action="search.php" method="post">
            <div class="input-group mb-2">
                <input name="search" type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                       aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary">search</button>
            </div>
        </form>

        <div class="row row-cols-4 g-4">
            @foreach(\App\Models\Post::query()->orderBy('name')->get() as $post)

                <div class="col">
                    <div class="card h-100">
                        <div class="list-group list-group-flush h-100">
                            <a href="{{ route('posts.show', $post) }}" class="h-100 p-3 list-group-item list-group-item-action">

                                @if($post->image_path)
                                    <div class="m-2" align="center">
                                        <img height="100" src="{{ \Storage::url($post->image_path) }}" alt="">
                                    </div>
                                @endif

                                <h5 class="card-title mb-0">
                                    {{ $post->name }}
                                </h5>
                                @if($post->description)
                                    <div class="mt-2 cope_text line-clamp">
                                        {{ $post->description }}
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="card-footer">
                            @if($post->tag)
                                #{{$post->tag->name}}
                            @else
                                {{ __('Without tag') }}
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        <div class="my-3">
            {{ $posts->links() }}
        </div>

    @endif

</x-layouts.app>
