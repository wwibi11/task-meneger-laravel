@extends('layouts.app')

@section('title', 'Tambah Tugas')

@section('content')

    <h2>Tambah Tugas</h2>

    <form method="POST" action="{{ route('tasks.store') }}" class="form">
        @csrf

        <label>
            Judul *
            <input type="text" name="judul" value="{{ old('judul') }}" required>
            @error('judul')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <label>
            Deskripsi
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <label>
            Prioritas *
            <select name="prioritas">
                @foreach (['rendah', 'sedang', 'tinggi'] as $p)
                    <option value="{{ $p }}" {{ old('prioritas', 'sedang') === $p ? 'selected' : '' }}>
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
            <input type="date" name="deadline" value="{{ old('deadline') }}">
            @error('deadline')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </label>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

@endsection