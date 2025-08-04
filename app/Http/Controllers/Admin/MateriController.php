<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Tampilkan semua materi dengan fitur pencarian
    public function index(Request $request)
    {
        $query = Materi::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $materi = $query->latest()->get();

        return view('admin.materi.index', compact('materi'));
    }

    // Form tambah materi
    public function create()
    {
        return view('admin.materi.create');
    }

    // Simpan materi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:10240', // max 10MB
        ], [
            'file.max' => 'Ukuran file maksimal adalah 10MB.',
            'file.mimes' => 'File harus berupa PDF.',
        ]);

        $materi = new Materi();
        $materi->judul = $validated['judul'];
        $materi->deskripsi = $validated['deskripsi'];

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi_files', 'public');
            $materi->file_path = $filePath;
        }

        $materi->save();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    // Tampilkan detail materi
    public function show($id)
    {
        $materi = Materi::with('comments.user')->findOrFail($id);
        return view('admin.materi.show', compact('materi'));
    }

    // Form edit materi
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('admin.materi.edit', compact('materi'));
    }

    // Update materi
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ], [
            'file.max' => 'Ukuran file maksimal adalah 10MB.',
            'file.mimes' => 'File harus berupa PDF.',
        ]);

        $materi->judul = $validated['judul'];
        $materi->deskripsi = $validated['deskripsi'];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }

            $filePath = $request->file('file')->store('materi_files', 'public');
            $materi->file_path = $filePath;
        }

        $materi->save();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    // Hapus materi
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    // Pratinjau file PDF
public function preview($id)
{
    $materi = Materi::findOrFail($id);

    if (!$materi->file_path || !Storage::disk('public')->exists($materi->file_path)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->file(storage_path('app/public/' . $materi->file_path));
}


}
