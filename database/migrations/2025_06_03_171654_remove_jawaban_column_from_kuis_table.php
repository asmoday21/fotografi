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
    if (Schema::hasColumn('kuis', 'jawaban')) {
        Schema::table('kuis', function (Blueprint $table) {
            $table->dropColumn('jawaban');
        });
    }
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuis', function (Blueprint $table) {
            //
        });
    }
};
