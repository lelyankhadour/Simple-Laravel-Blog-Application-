@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"> favourites list</h2>

    @if ($favorites->isEmpty())
        <p>   favourites list is empty .</p>
    @else
        <div class="row">
            @foreach ($favorites as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ $blog->content }}</p>
                            <a href="{{ route('users.blogs.show', $blog->id) }}" class="btn btn-primary">show more </a>
                            <form action="{{ route('favorites.toggle', $blog->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"> remove from list  </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection