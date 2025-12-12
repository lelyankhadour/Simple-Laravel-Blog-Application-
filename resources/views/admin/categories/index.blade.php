
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4"> categories list</h1>
    <div class="mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">  add new category</a>
    </div>
    @if(!$categories->isEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> name</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as  $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">update</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;"  >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>empty </p>
    @endif
</div>
@endsection