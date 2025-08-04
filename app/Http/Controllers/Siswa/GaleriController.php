<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Galeri;


class GaleriController extends Controller
{
    public function create()
    {
        return view('siswa.karya.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,mov,webm|max:10240',
        ]);

        $path = $request->file('file')->store('galeri', 'public');

        $karya = Galeri::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $path,
        ]);

        return redirect()->route('siswa.galeri.create')->with([
            'success' => 'Karya berhasil diupload!',
            'latest' => [
                'judul' => $karya->judul,
                'deskripsi' => Str::limit($karya->deskripsi, 200),
                'file' => $karya->file,
            ]
        ]);
    }

    public function index()
{
    $galeri = Galeri::latest()->get();
    return view('siswa.galeri.index', compact('galeri'));
}

}
