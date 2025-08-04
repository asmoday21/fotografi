<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'judul', 'deskripsi', 'file'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
