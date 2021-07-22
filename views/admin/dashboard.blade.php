<x-layouts.admin :title="__('Dashboard')">

    <div class="card mb-2">
        <div class="card-header">
            {{ __('Tags') }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ __('What is tag?') }}</h5>
            <p class="card-text">{{ __('A tag is an associated keyword that refers to a piece of information. Such metadata helps describe these pieces of information and quickly find them through a search query.') }}</p>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-primary">
                {{ __('Go to tags') }}
            </a>
        </div>
    </div>

    <div class="card mb-2">
        <div class="card-header">
            {{ __('Posts') }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ __('What is post?') }}</h5>
            <p class="card-text">{{ __('A post is an information block posted on a social network, blog, microblog, forum, etc. The post should contain a description and preferably an image, as well as have a title.') }}</p>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                {{ __('Go to posts') }}
            </a>
        </div>
    </div>

</x-layouts.admin>
