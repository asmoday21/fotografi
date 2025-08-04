<?php

// app/Models/Kuis.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;
protected $fillable = [
    'judul',
    'pertanyaan',
    'opsi_a',
    'opsi_b',
    'opsi_c',
    'opsi_d',
    'jawaban_benar',
    'user_id', // kalau pakai
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
