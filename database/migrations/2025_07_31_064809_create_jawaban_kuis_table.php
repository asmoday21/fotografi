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
       Schema::create('jawaban_kuis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('nilai_kuis_id')->constrained('nilai_kuis')->onDelete('cascade');
    $table->foreignId('soal_id')->constrained('kuis')->onDelete('cascade');
    $table->string('jawaban_siswa');
    $table->boolean('benar');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_kuis');
    }
};
