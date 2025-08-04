<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanKuis extends Model
{
    use HasFactory;

    protected $table = 'jawaban_kuis';

    protected $fillable = [
        'nilai_kuis_id',
        'soal_id',
        'jawaban_siswa',
        'benar'
    ];

    /**
     * Relasi ke nilai kuis.
     */
    public function nilai()
    {
        return $this->belongsTo(NilaiKuis::class, 'nilai_kuis_id');
    }

    /**
     * Relasi ke soal kuis.
     */
    public function soal()
    {
        return $this->belongsTo(Kuis::class, 'soal_id');
    }
}
