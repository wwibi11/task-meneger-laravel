<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Tampilkan daftar tugas
    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }



    // Tampilkan form tambah
    public function create()
    {
        return view('tasks.create');
    }

    // Proses simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'deadline'  => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan.');
    }





    // Tampilkan form edit
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    // Proses simpan perubahan
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'judul'     => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi',
            'deadline'  => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Tugas berhasil dihapus.');
    }

    // Toggle status selesai/belum
    public function toggle(Task $task)
    {
        $task->update([
            'status' => $task->status === 'selesai' ? 'belum' : 'selesai',
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Status tugas diperbarui.');
    }
}