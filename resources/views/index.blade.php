@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')

    {{-- Statistik --}}
    <div class="stats">
        <div class="stat-card">
            <div class="stat-value">{{ $tasks->count() }}</div>
            <div class="stat-label">Total</div>
        </div>
        <div class="stat-card success">
            <div class="stat-value">{{ $tasks->where('status', 'selesai')->count() }}</div>
            <div class="stat-label">Selesai</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">{{ $tasks->where('status', 'belum')->count() }}</div>
            <div class="stat-label">Belum</div>
        </div>
        <div class="stat-card danger">
            <div class="stat-value">
                {{ $tasks->filter(fn($t) => $t->deadline && $t->status === 'belum' && strtotime($t->deadline) < strtotime(date('Y-m-d')))->count() }}
            </div>
            <div class="stat-label">Terlambat</div>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="page-header">
        <h2>Daftar Tugas</h2>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <span>+</span> Tambah Tugas
        </a>
    </div>

    {{-- Daftar Task --}}
    @forelse ($tasks as $task)
        <div class="task-card priority-{{ $task->prioritas }} {{ $task->status === 'selesai' ? 'done' : '' }}">

            {{-- Judul --}}
            <div class="task-title">
                @if ($task->status === 'selesai')
                    <span class="check-icon">✓</span>
                @endif
                <span>{{ $task->judul }}</span>
            </div>

            {{-- Meta --}}
            <div class="task-meta">
                {{-- Badge prioritas --}}
                @if ($task->prioritas === 'tinggi')
                    <span class="badge badge-danger">🔥 Tinggi</span>
                @elseif ($task->prioritas === 'sedang')
                    <span class="badge badge-warning">⚡ Sedang</span>
                @else
                    <span class="badge badge-success">🌱 Rendah</span>
                @endif

                {{-- Status --}}
                @if ($task->status === 'selesai')
                    <span class="badge badge-success">✓ Selesai</span>
                @else
                    <span class="badge badge-secondary">○ Belum</span>
                @endif

                {{-- Deadline --}}
                @if ($task->deadline)
                    <span>📅 {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}</span>
                @else
                    <span>📅 Tanpa deadline</span>
                @endif
            </div>

            {{-- Deskripsi --}}
            @if ($task->deskripsi)
                <p class="task-desc">{{ $task->deskripsi }}</p>
            @endif

            {{-- Aksi --}}
            <div class="task-actions">

                {{-- Toggle --}}
                @if (Route::has('tasks.toggle'))
                    <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $task->status === 'selesai' ? 'btn-secondary' : 'btn-success' }}">
                            {{ $task->status === 'selesai' ? '↩ Tandai Belum' : '✓ Tandai Selesai' }}
                        </button>
                    </form>
                @endif

                {{-- Edit --}}
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-secondary">
                    ✏️ Edit
                </a>

                {{-- Hapus --}}
                <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                      onsubmit="return confirm('Hapus tugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        🗑 Hapus
                    </button>
                </form>

            </div>

        </div>
    @empty
        <div class="empty">
            <div class="empty-icon">📭</div>
            <h3>Belum ada tugas</h3>
            <p>Mulai dengan membuat tugas pertama kamu.</p>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">
                <span>+</span> Tambah Tugas Pertama
            </a>
        </div>
    @endforelse

@endsection