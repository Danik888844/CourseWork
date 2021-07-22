@props(['title' => null, 'showTags' => false])

<x-layouts.base :title="$title" {{ $attributes }}>

    <x-partials.navbar>
        <x-partials.navbar.link href="{{ url('/') }}">
            {{ __('Home') }}
        </x-partials.navbar.link>

        <x-partials.navbar.link href="{{ route('posts.index') }}">
            {{ __('Posts') }}
        </x-partials.navbar.link>

    </x-partials.navbar>

    <div class="container mt-3">
        <div class="row">
            @if($showTags)
                <div class="col-3">
                    <div class="card">

                        <div class="card-header">
                            {{ __('Tags') }}
                        </div>

                        <div class="list-group list-group-flush">
                            @foreach(\App\Models\Tag::query()->orderBy('name')->get() as $tag)
                                <a href="{{ route('tags.show', $tag) }}" class="list-group-item list-group-item-action">
                                #{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="card-header">
                            {{ __('Order by Name Desc:') }}
                        </div>

                        <div class="list-group list-group-flush">
                            @foreach(\App\Models\Post::query()->orderBy('name','desc')->get() as $post)
                                <a href="{{ route('posts.index', $post) }}" class="list-group-item list-group-item-action">
                                    {{ $post->name }}
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endif

            <div class="col">
                {{ $slot }}
            </div>
        </div>
    </div>

</x-layouts.base>
