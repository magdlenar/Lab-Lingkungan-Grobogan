<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ikus', function (Blueprint $table) {
            $table->id();
            $table->string('kabupaten_kota', 120)->index();

            // Rataan per parameter
            $table->decimal('rataan_no2', 10, 2)->nullable();
            $table->decimal('rataan_so2', 10, 2)->nullable();

            // Indeks dibagi bakumutu
            $table->decimal('indeks_no2', 10, 2)->nullable();
            $table->decimal('indeks_so2', 10, 2)->nullable();

            $table->decimal('rataan_indeks', 10, 2)->nullable();
            $table->decimal('nilai_iku', 10, 2)->nullable();
            $table->decimal('target_iku', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikus');
    }
};
