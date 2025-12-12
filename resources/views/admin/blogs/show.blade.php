@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">{{ $blog->title }}</h2>

    <div class="mb-4">
        <p>{{ $blog->content }}</p>
    </div>

    <div class="d-flex gap-2">
        @if ($blog->trashed())
            {{--  استرجاع المقال --}}
            <form action="{{ route('blogs.restore', $blog->id) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-success"> restore blog</button>
            </form>

            {{--  حذف نهائي --}}
            <form action="{{ route('blogs.forceDelete', $blog->id) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"> force delete</button>
            </form>
        @else
            {{--  حذف مؤقت (Soft Delete) --}}
            <form action="{{ route('blogs.destroy', $blog) }}" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning"> soft delete</button>
            </form>
        @endif

  
        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary"> update</a>

        {{--  زر الرجوع --}}
        <a href="{{ route('blogs.index') }}" class="btn btn-secondary">  back to the list</a>
    </div>
</div>
@endsection