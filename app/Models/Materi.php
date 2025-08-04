<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    // Nama tabel dalam database
    protected $table = 'materi';

    // Kolom-kolom yang bisa diisi massal
    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'ringkasan',
        'poin_penting',
        'video_url',
        'video_path',
    ];

    // Cast kolom agar poin_penting dibaca sebagai array
    protected $casts = [
        'poin_penting' => 'array',
    ];

    /**
     * Relasi: Materi memiliki banyak komentar (komentar utama saja)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)
                    ->whereNull('parent_id')
                    ->latest();
    }

    /**
     * Relasi: Semua komentar (termasuk reply)
     */
    public function komentars()
    {
        return $this->hasMany(Comment::class);
    }
}
