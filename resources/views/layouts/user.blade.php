<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'blogs')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"> Blogs </a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('users.blogs.index') }}">blogs</a></li>

               @auth
               <form action="{{ route('logout') }}" method="POST">
               @csrf
        <button type="submit" class="nav-link btn btn-link" >
        log out
    </button>
</form>

                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">log in  </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">rigester </a></li>
                @endauth
               
                
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

</body>
</html>