<?php
$previous = url()->previous();

if(request()->fullUrlIs($previous))
    $previous = route('admin.tags.index');

$tag = $tag ?? null;

?>

<x-layouts.admin :title="__($tag ? 'Edit tag' : 'New tag')">

    <x-slot name="toolbar">
        <a href="{{ $previous }}" class="btn btn-outline-danger">
            {{ __('Cancel') }}
        </a>
    </x-slot>

    <div class="row">
        <div class="col-4">

            <form class="card card-body"
                  action="{{ $tag ? route('admin.tags.update', $tag) : route('admin.tags.store') }}"
                  method="post">
                @csrf @if($tag) @method('put') @endif

                <div class="mb-3">

                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $tag->name ?? null) }}" type="text" id="name" name="name" />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">
                    {{ __($tag ? 'Update' : 'Add') }}
                </button>
            </form>

        </div>
    </div>

</x-layouts.admin>
