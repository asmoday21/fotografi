<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'materi_id',
        'user_id',
        'content',
        'parent_id',
    ];

    /**
     * Komentar ini milik materi tertentu
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Komentar ini dibuat oleh user tertentu
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Komentar ini memiliki balasan komentar
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->latest();
    }

    /**
     * Komentar ini adalah balasan dari komentar lain (jika ada)
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Scope: hanya ambil komentar utama
     */
    public function scopeUtama($query)
    {
        return $query->whereNull('parent_id');
    }
}
