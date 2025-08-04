<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoTutorial extends Model
{
    use HasFactory;

    protected $table = 'video_tutorials';

    protected $fillable = [
    'user_id',
    'judul',
    'deskripsi',
    'file_path',
    'url',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
