<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjek3dTable extends Migration
{
    public function up()
    {
        Schema::create('objek_3d', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable supaya aman jika belum login
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('objek_3d');
    }
}
