<x-layouts.admin :title="__('Tags')">

    <x-slot name="toolbar">
        <a class="btn btn-success" href="{{ route('admin.tags.create') }}">
            {{__('Add tag')}}
        </a>
    </x-slot>

    @if($tags->isEmpty())
        <div class="alert alert-secondary">
            {{ __('No tag added yet') }}.
            {{ __('Please,') }}
            <a class="alert-link" href="{{ route('admin.tags.create') }}">
                {{__('add one')}}
            </a>
        </div>
    @else

        @foreach($tags as $tag)
            <div class="card card-body my-3 d-flex flex-row align-items-center">
                <div class="me-auto">
                    {{ $tag->name }}
                </div>

                <form action="{{ route('admin.tags.destroy',$tag) }}" method="post">
                    @csrf @method('delete')

                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-warning">
                            {{ __('Edit') }}
                        </a>

                        <button class="btn btn-danger">
                            {{ __('Delete') }}
                        </button>
                    </div>

                </form>
            </div>
        @endforeach

        {{ $tags->links() }}

    @endif

</x-layouts.admin>
