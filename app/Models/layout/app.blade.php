<!DOCTYPE html>
<html>
<head>
    <title>Grade Recording System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand">Grade Recording System</span>
    </div>
    @auth
    @if(auth()->user()->role === 'student')
        <a href="/my-grades" class="btn btn-light btn-sm me-2">
            My Grades
        </a>
    @endif
@endauth
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>
