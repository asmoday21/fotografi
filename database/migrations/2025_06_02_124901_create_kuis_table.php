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
    Schema::create('kuis', function (Blueprint $table) {
        $table->id();
      $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade');
        $table->string('pertanyaan');
        $table->string('opsi_a');
        $table->string('opsi_b');
        $table->string('opsi_c');
        $table->string('opsi_d');
        $table->string('jawaban_benar');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
