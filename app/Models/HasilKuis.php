<?php
// app/Models/HasilKuis.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kuis;
use App\Models\User;

class HasilKuis extends Model
{
    protected $table = 'hasil_kuis';
    protected $fillable = [
    'user_id',
    'kuis_id',
    'nilai',
    'jawaban_user',
];


// HasilKuis.php
public function user()
{
    return $this->belongsTo(User::class);
}

public function kuis()
{
    return $this->belongsTo(Kuis::class);
}

}

