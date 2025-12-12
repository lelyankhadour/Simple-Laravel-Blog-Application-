@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">  add new category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label"> name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">back</a>
    </form>
</div>
@endsection