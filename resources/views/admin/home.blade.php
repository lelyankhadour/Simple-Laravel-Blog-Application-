@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"> admin page </h2>

    {{--  أزرار الإضافة --}}
    <div class="mb-4 d-flex gap-3">
        <a href="{{ route('blogs.create') }}" class="btn btn-primary"> add Blog</a>
        <a href="{{ route('categories.create') }}" class="btn btn-secondary"> add Category</a>
        <a href="{{ route('blogs.trashed') }}" class="btn btn-secondary"> trashed </a>
    </div>

    {{--  عرض المقالات  --}}
    <div class="row">
        @forelse ($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ $blog->content }}</p>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-primary"> show more</a>
                    </div>
                </div>
            </div>
        @empty
            <p> empty.</p>
        @endforelse
    </div>
</div>
@endsection