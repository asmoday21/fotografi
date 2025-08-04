<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriDiskusiController extends Controller
{
    public function show(Materi $materi)
    {
        $materi->load([
            'comments.user',              // pemilik komentar
            'comments.replies.user'       // pemilik balasan komentar
        ]);

        return view('guru.materi.diskusi', compact('materi'));
    }
    
}
