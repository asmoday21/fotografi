<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JawabanSiswa;
use App\Models\Galeri;
use App\Models\HasilKuis;
use Illuminate\Support\Facades\DB;

class HasilKuisController extends Controller
{
    public function index()
    {
        // Ambil hanya 1 data terakhir per user_id + kuis_id berdasarkan ID tertinggi
        $latestIds = DB::table('hasil_kuis')
            ->select(DB::raw('MAX(id) as id'))
            ->groupBy('user_id', 'kuis_id')
            ->pluck('id');

        // Ambil data lengkap dari hasil_kuis berdasarkan ID-ID di atas
        $hasil_kuis = HasilKuis::with(['user', 'kuis'])
            ->whereIn('id', $latestIds)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Total unik siswa yang menjawab kuis
        $totalJawabanKuis = JawabanSiswa::distinct('user_id')->count('user_id');

        // Total unik siswa yang mengumpulkan tugas (upload ke galeri)
        $totalTugasDikumpulkan = Galeri::distinct('user_id')->count('user_id');

        return view('hasilkuis.index', compact('hasil_kuis', 'totalJawabanKuis', 'totalTugasDikumpulkan'));
    }
}
