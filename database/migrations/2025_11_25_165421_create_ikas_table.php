<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ikas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_lokasi', 50)->index();              // bisa huruf/angka
            $table->text('alamat');
            $table->string('sungai', 120)->nullable();
            $table->date('tanggal');
            $table->string('kategori', 80)->nullable();

            $table->decimal('latitude', 10, 6)->nullable();         // bisa minus
            $table->decimal('longitude', 10, 6)->nullable();        // bisa minus

            // status mutu kelas 1-4 (angka/huruf)
            $table->string('kelas1', 50)->nullable();
            $table->string('kelas2', 50)->nullable();
            $table->string('kelas3', 50)->nullable();
            $table->string('kelas4', 50)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikas');
    }
};
