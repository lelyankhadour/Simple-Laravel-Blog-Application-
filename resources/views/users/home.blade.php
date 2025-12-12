@extends('layouts.user')

@section('content')
<div class="container text-center mt-5">
    <h1 class="mb-4">    welcome to our blogs</h1>


    <a href="{{ route('users.blogs.index') }}" class="btn btn-primary btn-lg mb-3">show blogs </a>

    @guest
        <div class="mt-3">
            <a href="{{ route('login') }}" class="btn btn-outline-secondary">log in </a>
            <a href="{{ route('register') }}" class="btn btn-outline-success">create an account </a>
        </div>
    @endguest
</div>
@endsection