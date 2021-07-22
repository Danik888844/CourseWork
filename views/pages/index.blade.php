<x-layouts.app title="Главная">

    @foreach(\App\Models\Post::all() as $post)
        <div class="card card-body my-3">

            {{ $post->name }}

        </div>
    @endforeach

</x-layouts.app>
