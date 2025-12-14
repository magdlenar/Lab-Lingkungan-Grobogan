<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('test_requests', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');

        $table->string('pic_name');
        $table->string('pic_phone');
        $table->string('pic_email');
        $table->text('sample_address');

        $table->enum('service_type', [
            'uji kualitas sungai',
            'uji kualitas limbah',
            'uji kualitas danau',
            'uji kualitas lindi'
        ]);

        $table->text('notes')->nullable();

        $table->string('letter_file'); // upload surat permohonan

        $table->enum('status', [
            'pemeriksaan kelengkapan',
            'persyaratan tidak lengkap',
            'persyaratan lengkap',
            'jadwal pengambilan sampel',
            'pengambilan sampel',
            'uji selesai',
            'verifikasi hasil uji',
            'penerbitan LHU',
            'selesai'
        ])->default('pemeriksaan kelengkapan');

        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}
};
