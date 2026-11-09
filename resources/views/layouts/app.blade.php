<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task Manager') — Task Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="app-header">
    <div class="container">
        <h1>
            <a href="{{ route('tasks.index') }}">
                <span>📝</span> Task Manager
            </a>
        </h1>
        <nav>
            <a href="{{ route('tasks.index') }}">Daftar</a>
            <a href="{{ route('tasks.create') }}">+ Tambah</a>
        </nav>
    </div>
</header>

<main class="app-main">
    <div class="container">

        @if (session('success'))
            <div class="alert-success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @yield('content')

    </div>
</main>

<footer class="app-footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} Task Manager — Dibuat dengan Laravel</p>
    </div>
</footer>

</body>
</html>