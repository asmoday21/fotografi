<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objek3D extends Model
{
    use HasFactory;

    protected $table = 'objek_3d';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'file',
    ];
}
