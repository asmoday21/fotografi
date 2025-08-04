<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['tipe', 'user_id', 'pesan', 'dibaca'];
}

