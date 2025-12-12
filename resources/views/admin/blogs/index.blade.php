@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-center">Blog List</h1>

        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">

                        {{-- صورة المقال --}}
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="Blog Image"
                                style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $blog->title }}</h5>

                            <p class="card-text text-muted" style="min-height: 70px;">
                                {{ Str::limit($blog->content, 100) }}
                            </p>
                            <div class="mb-3">
                                @foreach($blog->categories as $category)
                                    <span class="badge bg-secondary">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            {{-- الأزرار --}}
                            <div class="mt-auto d-flex justify-content-between">

                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-outline-primary">
                                    Update
                                </a>

                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No blogs until now.</p>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.home') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection