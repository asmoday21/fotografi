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
       Schema::create('nilai_kuis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
    $table->string('judul_kuis');
    $table->integer('jumlah_benar');
    $table->integer('jumlah_soal');
    $table->integer('nilai');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_kuis');
    }
};
