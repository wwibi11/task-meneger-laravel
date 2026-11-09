<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
</head>
<body>

    <h1>Daftar Tugas</h1>

    <p>
        <a href="{{ route('tasks.create') }}">+ Tambah Tugas</a>
    </p>

    @forelse ($tasks as $task)
        <div>
            <strong>{{ $task->judul }}</strong>
            — Prioritas: {{ $task->prioritas }}
            — Status: {{ $task->status }}
            — Deadline: {{ $task->deadline ?? '-' }}
            |
            <a href="{{ route('tasks.edit', $task) }}">Edit</a>
        </div>
    @empty
        <p>Belum ada tugas.</p>
    @endforelse

</body>
</html>