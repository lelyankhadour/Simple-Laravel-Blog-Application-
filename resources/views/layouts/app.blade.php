<!DOCTYPE html>
<html  >
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'control panel ')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>