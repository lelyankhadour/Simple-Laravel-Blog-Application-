@extends('layouts.app')

@section('content')
<div class="container">
    <h1>add a new blog:</h1>

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">content</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
{{-- حلقة لعرض الفئات الموجودة --}}
        <div class="mb-3">
            <label class="form-label">category</label><br>
            @foreach($categories as $category)
                <div class="form-check form-check-inline">
                        {{-- categories[] to return the input as an array used it in filter --}}
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}">
                    <label class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
          
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*"/>
        </div>

        <button type="submit" class="btn btn-success">save</button>
    </form>
</div>
@endsection
