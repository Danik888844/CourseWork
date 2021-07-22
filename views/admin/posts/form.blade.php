<?php
$previous = url()->previous();

if(request()->fullUrlIs($previous))
    $previous = route('admin.posts.index');

$post = $post ?? null;

?>

<x-layouts.admin :title="__($post ? 'Edit post' : 'New post')">

    <x-slot name="toolbar">
        <a href="{{ $previous }}" class="btn btn-outline-danger">
            {{ __('Cancel') }}
        </a>
    </x-slot>

    <div class="row">
        <div class="col-4">

            <form enctype="multipart/form-data" class="card card-body"
                  action="{{ $post ? route('admin.posts.update', $post) : route('admin.posts.store') }}"
                  method="post">
                @csrf @if($post) @method('put') @endif

                <div class="mb-3">
                    <label for="tag_id" class="form-label">{{ __('Tag') }}</label>

                    <select class="form-select @error('tag_id') is-invalid @enderror" name="tag_id" id="tag_id">
                        <option value="">{{ __('Without tag') }}</option>

                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{old('tag_id', $post->tag->id ?? null) == $tag->id ? 'selected' : ''}}>
                                 #{{ $tag->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('tag_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $post->name ?? null) }}" type="text" id="name" name="name" />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image">Картинка поста</label>
                </div>
                <div class="mb-3">
                    <input type="file" name="image" id="image" accept="image/*" />
                    @error('image')
                    <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('Description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror "
                              name="description" id="description">{{ old('description', $post->description ?? null) }}</textarea>

                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">
                    {{ __($post ? 'Update' : 'Add') }}
                </button>
            </form>

        </div>
    </div>

</x-layouts.admin>
