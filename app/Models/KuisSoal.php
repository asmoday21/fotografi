<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisSoal extends Model
{
    use HasFactory;

    protected $table = 'kuis_soal';

    protected $fillable = [
        'kuis_judul_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
    ];

    /**
     * Relasi: Soal ini milik satu judul kuis
     */
    public function judul()
    {
        return $this->belongsTo(KuisJudul::class, 'kuis_judul_id');
    }
}
