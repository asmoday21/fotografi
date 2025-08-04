<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->text('ringkasan')->nullable();
            $table->json('poin_penting')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dropColumn(['ringkasan', 'poin_penting']);
        });
    }
};
