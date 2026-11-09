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
    <h1><a href="{{ route('tasks.index') }}">📝 Task Manager</a></h1>
    <nav>
        <a href="{{ route('tasks.index') }}">Daftar Tugas</a>
        <a href="{{ route('tasks.create') }}">Tambah Tugas</a>
    </nav>
</header>

<main class="app-main">

    @if (session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @yield('content')

</main>

<footer class="app-footer">
    <p>&copy; {{ date('Y') }} Task Manager — Latihan Laravel</p>
</footer>

</body>
</html>