@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4"> trashed list</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($blogs->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>title</th>
                    <th>image</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>
                                <img src="{{ asset('storage/' . $blog->image) }}" width="100"> 
                        </td>
                        <td>
                            <form action="{{ route('blogs.restore', $blog->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-success">restore</button>
                            </form>

                            <form action="{{ route('blogs.forceDelete', $blog->id) }}" method="POST" style="display:inline-block;"                                 >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"> force delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <p>emplty </p>
    @endif
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">back</a>
</div>
@endsection