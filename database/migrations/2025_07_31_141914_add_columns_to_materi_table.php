<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('materi', function (Blueprint $table) {
        if (!Schema::hasColumn('materi', 'ringkasan')) {
            $table->text('ringkasan')->nullable();
        }

        if (!Schema::hasColumn('materi', 'poin_penting')) {
            $table->json('poin_penting')->nullable();
        }

        if (!Schema::hasColumn('materi', 'video_url')) {
            $table->string('video_url')->nullable();
        }

        if (!Schema::hasColumn('materi', 'video_path')) {
            $table->string('video_path')->nullable();
        }
    });
}

    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dropColumn(['ringkasan', 'poin_penting', 'video_url', 'video_path']);
        });
    }
};
