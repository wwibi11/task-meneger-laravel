@extends('layouts.app')

@section('title', 'Edit Tugas')

@section('content')

    <div class="page-header">
        <h2>Edit Tugas</h2>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form method="POST" action="{{ route('tasks.update', $task) }}" class="form-container">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="judul">Judul <span class="required">*</span></label>
            <input type="text" name="judul" id="judul"
                   class="form-control @error('judul') is-invalid @enderror"
                   value="{{ old('judul', $task->judul) }}" required>
            @error('judul')
                <div class="error-message">⚠ {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                      class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $task->deskripsi) }}</textarea>
            @error('deskripsi')
                <div class="error-message">⚠ {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="prioritas">Prioritas <span class="required">*</span></label>
            <select name="prioritas" id="prioritas"
                    class="form-control @error('prioritas') is-invalid @enderror">
                @foreach (['rendah', 'sedang', 'tinggi'] as $p)
                    <option value="{{ $p }}" {{ old('prioritas', $task->prioritas) === $p ? 'selected' : '' }}>
                        {{ ucfirst($p) }}
                    </option>
                @endforeach
            </select>
            @error('prioritas')
                <div class="error-message">⚠ {{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline"
                   class="form-control @error('deadline') is-invalid @enderror"
                   value="{{ old('deadline', $task->deadline) }}">
            @error('deadline')
                <div class="error-message">⚠ {{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Update</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>

@endsection