@extends('layouts.user')

@section('title', ' show ')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $blog->title }}</h2>

    @if($blog->image)
        <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid mb-3" style="width: 120px; alt="image ">
    @endif

    <p>{{ $blog->content }}</p>

    @auth
        <form action="{{ route('favorites.toggle', $blog->id) }}" method="POST" class="mt-3">
            @csrf
            @if($isFavorite)
                <button type="submit" class="btn btn-danger"> remove from fav list </button>
            @else
                <button type="submit" class="btn btn-warning"> add to the fav list </button>
            @endif
        </form>
    @endauth
</div>
@endsection
