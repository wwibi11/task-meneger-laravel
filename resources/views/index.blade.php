<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
</head>
<body>

    <h1>Daftar Tugas</h1>

    {{-- Flash message --}}
    @if (session('success'))
        <p style="color: green; font-weight: bold;">
            ✅ {{ session('success') }}
        </p>
    @endif

    {{-- Tombol tambah --}}
    <p>
        <a href="{{ route('tasks.create') }}">+ Tambah Tugas</a>
    </p>

    {{-- Daftar task --}}
    @forelse ($tasks as $task)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; border-radius: 5px;">

            {{-- Judul + indikator selesai --}}
            <strong>{{ $task->judul }}</strong>
            @if ($task->status === 'selesai')
                <span style="color: green;">[✓ Selesai]</span>
            @endif

            <br>

            {{-- Info task --}}
            <small>
                Prioritas: <strong>{{ ucfirst($task->prioritas) }}</strong> |
                Status: <strong>{{ ucfirst($task->status) }}</strong> |
                Deadline: {{ $task->deadline ?? '-' }}
            </small>

            {{-- Deskripsi --}}
            @if ($task->deskripsi)
                <p style="margin: 5px 0;">{{ $task->deskripsi }}</p>
            @endif

            <br>

            {{-- Tombol Toggle (kalau route tersedia) --}}
            @if (Route::has('tasks.toggle'))
                <form method="POST" action="{{ route('tasks.toggle', $task) }}" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">
                        {{ $task->status === 'selesai' ? 'Tandai Belum' : 'Tandai Selesai' }}
                    </button>
                </form>
            @endif

            {{-- Tombol Edit --}}
            <a href="{{ route('tasks.edit', $task) }}">Edit</a>

            {{-- Tombol Hapus --}}
            <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                  style="display:inline;"
                  onsubmit="return confirm('Hapus tugas ini?')">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>

        </div>
    @empty
        <p>Belum ada tugas. Klik "+ Tambah Tugas" untuk membuat yang pertama.</p>
    @endforelse

</body>
</html>