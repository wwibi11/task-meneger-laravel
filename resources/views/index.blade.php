@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')

    <p>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Tambah Tugas</a>
    </p>

    @forelse ($tasks as $task)
        <div class="task-card {{ $task->status === 'selesai' ? 'done' : '' }}">

            {{-- Judul --}}
            <p class="task-title">
                {{ $task->judul }}
                @if ($task->status === 'selesai')
                    <span style="color: green;">[✓ Selesai]</span>
                @endif
            </p>

            {{-- Meta --}}
            <p class="task-meta">
                Prioritas:
                @if ($task->prioritas === 'tinggi')
                    <span class="badge badge-danger">Tinggi</span>
                @elseif ($task->prioritas === 'sedang')
                    <span class="badge badge-warning">Sedang</span>
                @else
                    <span class="badge badge-success">Rendah</span>
                @endif
                |
                Status: {{ ucfirst($task->status) }} |
                Deadline: {{ $task->deadline ?? '-' }}
            </p>

            {{-- Deskripsi --}}
            @if ($task->deskripsi)
                <p class="task-desc">{{ $task->deskripsi }}</p>
            @endif

            {{-- Aksi --}}
            <div class="task-actions">

                {{-- Toggle --}}
                @if (Route::has('tasks.toggle'))
                    <form method="POST" action="{{ route('tasks.toggle', $task) }}" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-secondary btn-sm">
                            {{ $task->status === 'selesai' ? 'Tandai Belum' : 'Tandai Selesai' }}
                        </button>
                    </form>
                @endif

                {{-- Edit --}}
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary btn-sm">Edit</a>

                {{-- Hapus --}}
                <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                      style="display:inline;"
                      onsubmit="return confirm('Hapus tugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>

            </div>

        </div>
    @empty
        <div class="empty">
            <p>Belum ada tugas.</p>
            <p>Klik <strong>+ Tambah Tugas</strong> untuk membuat yang pertama.</p>
        </div>
    @endforelse

@endsection