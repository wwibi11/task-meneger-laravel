<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
  public function up(): void
{
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('judul', 150);
        $table->text('deskripsi')->nullable();
        $table->enum('prioritas', ['rendah', 'sedang', 'tinggi'])->default('sedang');
        $table->enum('status', ['belum', 'selesai'])->default('belum');
        $table->date('deadline')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
