<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_anggota')->unique(); // Tambahkan ini
            $table->string('nama');                  // Tambahkan ini
            $table->enum('jenis_kelamin', ['L', 'P']); // Tambahkan ini
            $table->string('telepon');               // Tambahkan ini
            $table->text('alamat');                  // Tambahkan ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};