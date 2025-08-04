<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diskusi extends Model
{
    use HasFactory;

    protected $table = 'diskusi';

    protected $fillable = ['pengirim_id', 'role', 'pesan'];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }
}
