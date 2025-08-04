<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('materi_diskusi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('materi_diskusi');
    }
};
