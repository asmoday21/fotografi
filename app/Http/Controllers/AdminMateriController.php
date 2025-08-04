<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class AdminMateriController extends Controller
{
  public function index()
{
    $materi = Materi::latest()->get(); // atau paginate jika data banyak
    return view('admin.materi.index', compact('materi'));
}


    public function create() {
        return view('admin.materi.create');
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048'
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->store('materi', 'public');
        }

        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $fileName
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan');
    }

    public function edit(Materi $materi) {
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'nullable|mimes:pdf|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $fileName = $request->file('file')->store('materi', 'public');
            $materi->file = $fileName;
        }

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $materi->file
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui');
    }

    public function destroy(Materi $materi) {
        $materi->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus');
    }
    
}
