<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas</title>
</head>
<body>

    <h1>Tambah Tugas</h1>

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <p>
            <label>Judul *</label><br>
            <input type="text" name="judul" value="{{ old('judul') }}" required>
            @error('judul')
                <br><small style="color:red">{{ $message }}</small>
            @enderror
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <br><small style="color:red">{{ $message }}</small>
            @enderror
        </p>

        <p>
            <label>Prioritas *</label><br>
            <select name="prioritas">
                @foreach (['rendah', 'sedang', 'tinggi'] as $p)
                    <option value="{{ $p }}" {{ old('prioritas', 'sedang') === $p ? 'selected' : '' }}>
                        {{ ucfirst($p) }}
                    </option>
                @endforeach
            </select>
            @error('prioritas')
                <br><small style="color:red">{{ $message }}</small>
            @enderror
        </p>

        <p>
            <label>Deadline</label><br>
            <input type="date" name="deadline" value="{{ old('deadline') }}">
            @error('deadline')
                <br><small style="color:red">{{ $message }}</small>
            @enderror
        </p>

        <button type="submit">Simpan</button>
        <a href="{{ route('tasks.index') }}">Batal</a>
    </form>

</body>
</html>