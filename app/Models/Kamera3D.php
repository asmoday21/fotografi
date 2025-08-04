<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamera3D extends Model
{
    // use HasFactory;

   protected $table = 'kamera3ds'; // sesuai dengan nama tabel di migration

   protected $fillable = ['nama', 'deskripsi', 'file_model'];
}
