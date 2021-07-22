<x-layouts.admin :title="$tag->name">

    <x-slot name="toolbar">
        <form action="{{ route('admin.tags.destroy',$tag) }}" method="post">
            @csrf @method('delete')

            <div class="btn-group">
                <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-warning">
                    {{ __('Edit') }}
                </a>

                <button class="btn btn-danger">
                    {{ __('Delete') }}
                </button>
            </div>

        </form>
    </x-slot>

</x-layouts.admin>
