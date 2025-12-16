<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Grade Recording System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Grade Recording System</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-danger">Logout</button>
        </form>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 bg-light vh-100 p-3">
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                </li>

                @if(auth()->user()->role === 'teacher')
                    <li class="nav-item mb-2">
                        <a href="{{ route('teacher.grades') }}" class="nav-link">My Grades</a>
                    </li>
                @endif

                @if(auth()->user()->role === 'department_head')
                    <li class="nav-item mb-2">
                        <a href="{{ route('dept.approvals') }}" class="nav-link">Approvals</a>
                    </li>
                @endif

                @if(auth()->user()->role === 'registrar')
                    <li class="nav-item mb-2">
                        <a href="{{ route('registrar.index') }}" class="nav-link">Registrar Panel</a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-md-10 p-4">
            {{-- THIS IS THE MOST IMPORTANT LINE --}}
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>
