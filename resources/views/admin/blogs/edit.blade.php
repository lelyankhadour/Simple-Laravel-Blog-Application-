@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"> update blog</h1>

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">contant</label>
            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">categories</label><br>
            @foreach($categories as $category)
                <div class="form-check form-check-inline">
                
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}">
        
                    
                    <label class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">image</label>
            {{-- عرض الصورة القديمة إن وجدت --}}
            @if($blog->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" width="150">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*" />
        </div>

        <button type="submit" class="btn btn-primary">update</button>
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">back</a>
    </form>
</div>
@endsection
