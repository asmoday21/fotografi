<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Materi;
use App\Models\Kuis;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total dan yang sudah disusun untuk materi
        $totalMateri = Materi::where('guru_id', Auth::id())->count();
        $materiDisusun = Materi::where('guru_id', Auth::id())
                               ->whereNotNull('isi')
                               ->count();
        $materiProgress = ($totalMateri > 0) ? round(($materiDisusun / $totalMateri) * 100) : 0;

        // Hitung total dan yang sudah disusun untuk kuis
        $totalKuis = Kuis::where('guru_id', Auth::id())->count();
        $kuisDisusun = Kuis::where('guru_id', Auth::id())
                           ->whereNotNull('soal')
                           ->count();
        $kuisProgress = ($totalKuis > 0) ? round(($kuisDisusun / $totalKuis) * 100) : 0;

        // Kirim data ke view
        return view('guru.dashboard', compact('materiProgress', 'kuisProgress', 'totalMateri', 'materiDisusun', 'totalKuis', 'kuisDisusun'));
    }
    public function dashboard()
{
    $totalMateri = Materi::where('guru_id', auth()->id())->count();
    $materiDisusun = Materi::where('guru_id', auth()->id())->where('status', 'disusun')->count();
    $materiProgress = ($totalMateri > 0) ? round(($materiDisusun / $totalMateri) * 100) : 0;

    $totalKuis = Kuis::where('guru_id', auth()->id())->count();
    $kuisDisusun = Kuis::where('guru_id', auth()->id())->where('status', 'disusun')->count();
    $kuisProgress = ($totalKuis > 0) ? round(($kuisDisusun / $totalKuis) * 100) : 0;

    return view('guru.dashboard', compact(
        'totalMateri',
        'materiDisusun',
        'materiProgress',
        'totalKuis',
        'kuisDisusun',
        'kuisProgress'
    ));
}

}
