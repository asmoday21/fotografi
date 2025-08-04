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
    Schema::table('materi', function (Blueprint $table) {
        $table->longText('file')->change(); // ubah dari string ke longText
    });
}

public function down(): void
{
    Schema::table('materi', function (Blueprint $table) {
        $table->string('file')->change(); // rollback ke string
    });
}

};
