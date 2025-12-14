<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('test_requests', function (Blueprint $table) {
            $table->json('fix_fields')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('test_requests', function (Blueprint $table) {
            $table->dropColumn('fix_fields');
        });
    }
};
