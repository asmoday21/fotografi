<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;

class MateriDiskusiController extends Controller
{
    public function show(Materi $materi)
    {
        $materi->load(['komentars.replies.user', 'komentars.user']);
        return view('siswa.materi.diskusi', compact('materi'));
    }
}
