<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('tasks', 'daftar_tugas');
    }

    public function down(): void
    {
        Schema::rename('daftar_tugas', 'tasks');
    }
};
