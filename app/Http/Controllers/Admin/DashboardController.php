<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Materi;
use App\Models\HasilKuis;
use Illuminate\Http\Request;
use App\Models\VideoTutorial;
use App\Models\Galeri;
use App\Models\Objek3D;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = User::role('Siswa')->count();
        $jumlahGuru = User::role('Guru')->count();
        $jumlahMateri = Materi::count();

        // Cek apakah kolom 'skor' ada sebelum dihitung rata-rata
        $rataRataNilai = Schema::hasColumn('hasil_kuis', 'skor') ? HasilKuis::avg('skor') : 0;

        $users = User::all();
        $materi = Materi::all();
        $videos = VideoTutorial::all();
        $galeri = Galeri::all();
        $karya = Objek3D::all();

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahGuru',
            'jumlahMateri',
            'rataRataNilai',
            'users',
            'materi',
            'videos',
            'galeri',
            'karya'
        ));
    }
}
