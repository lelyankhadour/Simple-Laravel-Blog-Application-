@extends('layouts.user')

@section('title', ' blogs')

@section('content')
<div class="container">
    <h2 class="mb-4"> blogs</h2>
<form method="GET" action="{{ route('users.blogs.index') }}" class="p-3 border rounded mb-3 bg-light">

    <div class="mb-2">
        <label class="form-label fw-bold">Filter by Category</label>
    </div>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-3 col-6 mb-2">
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="categories[]"
                           value="{{ $category->id }}"
                           {{ in_array($category->id, request()->input('categories', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">
                        {{ $category->name }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-info btn-sm mt-2">Filter</button>
</form>
    <div class="row">
        @forelse($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" style="width: 120px alt="image ">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        {{-- لعرض جزء من المحتوى  --}}
                        <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                        <a href="{{ route('users.blogs.show', $blog->id) }}" class="btn btn-sm btn-primary">show more </a>

                        @auth
                            <form action="{{ route('favorites.toggle', $blog->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-warning">
                                    {{ auth()->user()->favorites->contains($blog->id) ? ' remove from the list ' : 'add to the list  ' }}
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p>no blogs   </p>
        @endforelse
    </div> 
</div>
@endsection