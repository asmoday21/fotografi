<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKuis extends Model
{
    use HasFactory;

    protected $table = 'nilai_kuis';

    protected $fillable = [
        'siswa_id',
        'judul_kuis',
        'jumlah_benar',
        'jumlah_soal',
        'nilai'
    ];

    /**
     * Relasi ke tabel jawaban kuis.
     */
    public function jawaban()
    {
        return $this->hasMany(JawabanKuis::class);
    }

    /**
     * Relasi ke user/siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
}
