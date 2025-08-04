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
    Schema::table('hasil_kuis', function (Blueprint $table) {
        $table->decimal('skor', 5, 2)->nullable(); // misalnya untuk nilai 0.00 - 100.00
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_kuis', function (Blueprint $table) {
            //
        });
    }
};
