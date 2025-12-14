<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_request_id')->unique(); 
            // unique -> satu permintaan uji hanya punya satu hasil uji

            // ===== Parameter hasil uji (string biar bisa 12 / 7.5 / 30% dll) =====
            $table->string('suhu')->nullable();
            $table->string('ph')->nullable();
            $table->string('do')->nullable();
            $table->string('tss')->nullable();
            $table->string('tds')->nullable();
            $table->string('cod')->nullable();
            $table->string('bod')->nullable();
            $table->string('nitrit')->nullable();
            $table->string('nitrat')->nullable();
            $table->string('total_fosfat')->nullable();
            $table->string('amonia')->nullable();
            $table->string('minyak_lemak')->nullable();
            $table->string('mbas')->nullable();

            $table->enum('status_mutu', [
                'memenuhi',
                'cemar ringan',
                'cemar sedang',
                'cemar berat'
            ])->nullable();

            $table->string('nilai_ika')->nullable();

            // upload dokumen hasil uji
            $table->string('result_file')->nullable();

            $table->timestamps();

            $table->foreign('test_request_id')
                ->references('id')->on('test_requests')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};
