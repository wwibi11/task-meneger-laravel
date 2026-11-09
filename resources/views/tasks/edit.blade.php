@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')

    <h2>Edit Tugas</h2>

    <form method="POST" action="{{ route('tasks.update', $task) }}" class="form">
        @csrf
        @method('PUT')

        <label>
            Judul *
            <input type="text" name="judul" value="{{ old('judul', $task->judul) }}" required>
            @error('judul')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <label>
            Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi', $task->deskripsi) }}</textarea>
            @error('deskripsi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <label>
            Prioritas *
            <select name="prioritas">
                @foreach (['rendah', 'sedang', 'tinggi'] as $p)
                    <option value="{{ $p }}" {{ old('prioritas', $task->prioritas) === $p ? 'selected' : '' }}>
                        {{ ucfirst($p) }}
                    </option>
                @endforeach
            </select>
            @error('prioritas')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <label>
            Deadline
            <input type="date" name="deadline" value="{{ old('deadline', $task->deadline) }}">
            @error('deadline')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

@endsection