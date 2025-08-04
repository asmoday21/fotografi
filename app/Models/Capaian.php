<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'materi_id',
        'video_id',
        'type',
    ];
}
