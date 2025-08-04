<?php
namespace App\Http\Controllers;

use App\Models\Diskusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiskusiController extends Controller
{
    public function index()
    {
        // Ambil data diskusi beserta relasi pengirim, urutkan terbaru
        $diskusi = Diskusi::with('pengirim')->latest()->get();
        return view('diskusi.index', compact('diskusi'));
    }

 public function store(Request $request)
{
    $request->validate([
        'pesan' => 'required|string|max:1000',
    ]);
    Diskusi::create([
        'pengirim_id' => Auth::id(),
        'role'        => Auth::user()->role, // Nilai ini harus 'Siswa' atau 'Guru'
        'pesan'       => $request->pesan,
    ]);

    return back()->with('success', 'Pesan berhasil dikirim!');
}
}
