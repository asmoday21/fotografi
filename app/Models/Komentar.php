<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $fillable = ['materi_id', 'user_id', 'content', 'parent_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(Komentar::class, 'parent_id');
    }

    public function materi()
{
    return $this->belongsTo(\App\Models\Materi::class);
}   
}