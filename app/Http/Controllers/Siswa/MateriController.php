<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\VideoTutorial;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::latest()->get();
        $videos = VideoTutorial::latest()->get(); // Ambil semua video

        return view('siswa.materi.index', compact('materi', 'videos'));
    }

    public function show($id)
{
    $materi = Materi::findOrFail($id);
    $videos = VideoTutorial::latest()->get(); // optional jika mau tampilkan video
     $materi = Materi::with('comments.replies.user','comments.user')->findOrFail($id);
        return view('siswa.materi.show', compact('materi'));

    return view('siswa.materi.show', compact('materi', 'videos'));
}

}
