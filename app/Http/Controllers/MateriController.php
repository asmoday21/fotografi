<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::all();
        return view('admin.materi.index', compact('materi'));
    }

    public function create()
    {
        return view('materi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'file' => 'nullable|file|mimes:pdf,zip,rar|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('materi', 'public');
        }

        Materi::create($data);
        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'file' => 'nullable|file|mimes:pdf,zip,rar|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($materi->file) {
                Storage::disk('public')->delete($materi->file);
            }
            $data['file'] = $request->file('file')->store('materi', 'public');
        }

        $materi->update($data);
        return redirect()->route('materi.index')->with('success', 'Materi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        if ($materi->file) {
            Storage::disk('public')->delete($materi->file);
        }
        $materi->delete();

        return back()->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * ✅ Tampilkan detail materi + komentar & balasan.
     */
    public function show($id)
    {
        $materi = Materi::with(['comments.replies.user', 'comments.user'])->findOrFail($id);
        return view('materi.show', compact('materi'));
    }

    /**
     * ✅ Simpan komentar baru atau balasan komentar.
     */
    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        Comment::create([
            'materi_id' => $id,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }

    public function diskusi($id) {
    $materi = Materi::findOrFail($id);
    $komentar = \App\Models\Komentar::with(['user', 'replies.user'])
        ->where('materi_id', $id)
        ->whereNull('parent_id')
        ->latest()->get();
    return view('materi.diskusi', compact('materi', 'komentar'));
}

}
