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
            Schema::table('test_requests', function (Blueprint $table) {
                $table->date('sample_pickup_date')->nullable();
            });
        }

        public function down()
        {
            Schema::table('test_requests', function (Blueprint $table) {
                $table->dropColumn('sample_pickup_date');
            });
        }
};
