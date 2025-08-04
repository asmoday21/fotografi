<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri'; // <-- INI WAJIB, karena nama tabel bukan jamak

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
