<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up()
{
    Schema::create('kamera3ds', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->text('deskripsi');
        $table->string('file_model');
        $table->timestamps();
    });
}


public function down(): void
{
    Schema::dropIfExists('kamera3ds');
}

};
