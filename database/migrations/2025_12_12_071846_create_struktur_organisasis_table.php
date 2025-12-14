<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('struktur_organisasis', function (Blueprint $table) {
            $table->id();

            $table->string('jabatan');
            $table->string('nama');
            $table->string('foto')->nullable();

            // urutan untuk sorting per level (semakin kecil semakin kiri/atas)
            $table->unsignedInteger('urutan')->default(0);

            // relasi ke atasan
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('struktur_organisasis')
                ->nullOnDelete();

            $table->timestamps();

            $table->index(['parent_id', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_organisasis');
    }
};
