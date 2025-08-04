<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryaSiswa extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'deskripsi', 'file', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
