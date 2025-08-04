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
    Schema::create('soal_kuis', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('kuis_id');
        $table->text('pertanyaan');
        $table->string('opsi_a');
        $table->string('opsi_b');
        $table->string('opsi_c');
        $table->string('opsi_d');
        $table->string('jawaban'); // bisa: 'A', 'B', 'C', 'D'
        $table->timestamps();

        $table->foreign('kuis_id')->references('id')->on('kuis')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_kuis');
    }
};
