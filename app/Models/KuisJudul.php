<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisJudul extends Model
{
    use HasFactory;

    protected $table = 'kuis_judul';

    protected $fillable = ['judul'];

    /**
     * Relasi: Satu judul memiliki banyak soal
     */
    public function soal()
    {
        return $this->hasMany(KuisSoal::class, 'kuis_judul_id');
    }
}
