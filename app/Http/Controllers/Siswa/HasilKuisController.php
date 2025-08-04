<?php
namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\HasilKuis;

class HasilKuisController extends Controller
{
    public function index()
    {
        $hasil = HasilKuis::with('kuis')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.hasilkuis.index', compact('hasil'));
    }
    
}
