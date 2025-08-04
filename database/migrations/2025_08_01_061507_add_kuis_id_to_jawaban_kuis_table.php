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
    Schema::table('jawaban_kuis', function (Blueprint $table) {
        $table->unsignedBigInteger('kuis_id')->nullable()->after('id'); // tambahkan kolom
        $table->foreign('kuis_id')->references('id')->on('kuis')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jawaban_kuis', function (Blueprint $table) {
            //
        });
    }
};
