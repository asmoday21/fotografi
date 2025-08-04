<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Galeri;
use App\Models\Materi;
use App\Models\Kuis;
use App\Models\HasilKuis;
use App\Models\Objek3D;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard untuk siswa.
     */
    public function index()
    {
        $userId = Auth::id(); // Ambil ID siswa yang sedang login

        $totalMateri = Materi::count();
    $materiSelesai = HasilKuis::where('siswa_id', $userId)
                              ->distinct('kuis_id')
                              ->count('kuis_id');


            // Hitung persentase perkembangan
    $materiProgress = $totalMateri > 0 ? round(($materiSelesai / $totalMateri) * 100) : 0;

        return view('siswa.dashboard', [
            'total_karya'   => Galeri::where('user_id', $userId)->count(),
            'total_materi'  => Materi::count(),
            'total_objek3d' => Objek3D::count(),
            'total_kuis'    => Kuis::count(),
            'total_skor'    => HasilKuis::where('siswa_id', $userId)->count(),
             'materiProgress'  => $materiProgress, // 👈 kirim ke view
        ]);
    }
}
