<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Komentar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MateriController extends Controller
{
    // 🔍 Tampilkan semua materi
    public function index(Request $request)
    {
        $query = Materi::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        $materi = $query->latest()->get();

        return view('guru.materi.index', compact('materi'));
    }

    // ➕ Form tambah materi
    public function create()
    {
        return view('guru.materi.create');
    }

    // 💾 Simpan materi baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
            'ringkasan' => 'nullable|string',
            'poin_penting' => 'nullable|array',
            'poin_penting.*' => 'nullable|string|max:255',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4|max:51200',
        ]);

        try {
            $filePath = null;
            if ($request->hasFile('file')) {
                $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('materi', $fileName, 'public');
            }

            $videoPath = null;
            if ($request->hasFile('video_file')) {
                $videoName = time() . '_' . $request->file('video_file')->getClientOriginalName();
                $videoPath = $request->file('video_file')->storeAs('materi/videos', $videoName, 'public');
            }

            Materi::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file_path' => $filePath,
                'ringkasan' => $request->ringkasan,
                'poin_penting' => $request->poin_penting,
                'video_url' => $request->video_url,
                'video_path' => $videoPath,
            ]);

            return redirect()->route('guru.materi.index')->with('success', '✅ Materi berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan materi: ' . $e->getMessage());
            return back()->withErrors('❌ Gagal menyimpan materi.')->withInput();
        }
    }

    // ✏️ Form edit
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        return view('guru.materi.edit', compact('materi'));
    }

    // 🔄 Update materi
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
            'ringkasan' => 'nullable|string',
            'poin_penting' => 'nullable|array',
            'poin_penting.*' => 'nullable|string|max:255',
            'video_url' => 'nullable|url',
            'video_file' => 'nullable|file|mimes:mp4|max:51200',
        ]);

        try {
            $materi->judul = $request->judul;
            $materi->deskripsi = $request->deskripsi;
            $materi->ringkasan = $request->ringkasan;
            $materi->poin_penting = $request->poin_penting;
            $materi->video_url = $request->video_url;

            if ($request->hasFile('file')) {
                if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                    Storage::disk('public')->delete($materi->file_path);
                }

                $materi->file_path = $request->file('file')->store('materi', 'public');
            }

            if ($request->hasFile('video_file')) {
                if ($materi->video_path && Storage::disk('public')->exists($materi->video_path)) {
                    Storage::disk('public')->delete($materi->video_path);
                }

                $materi->video_path = $request->file('video_file')->store('materi/videos', 'public');
            }

            $materi->save();

            return redirect()->route('guru.materi.index')->with('success', '✅ Materi berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal update materi: ' . $e->getMessage());
            return back()->withErrors('❌ Gagal memperbarui materi.')->withInput();
        }
    }

    // ❌ Hapus materi
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        try {
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }

            if ($materi->video_path && Storage::disk('public')->exists($materi->video_path)) {
                Storage::disk('public')->delete($materi->video_path);
            }

            $materi->delete();

            return redirect()->route('guru.materi.index')->with('success', '✅ Materi berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal hapus materi: ' . $e->getMessage());
            return back()->withErrors('❌ Gagal menghapus materi.');
        }
    }

    // 🔍 Pratinjau file
    public function preview($id)
    {
        $materi = Materi::findOrFail($id);

        if (!$materi->file_path || !Storage::disk('public')->exists($materi->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->file(storage_path('app/public/' . $materi->file_path));
    }

    // 💬 Halaman diskusi
    public function diskusi($id)
    {
        $materi = Materi::with(['komentars.user', 'komentars.replies.user'])->findOrFail($id);
        return view('guru.materi.diskusi', compact('materi'));
    }

    // 💬 Simpan komentar utama
    public function simpanKomentar(Request $request, $id)
    {
        $request->validate(['isi' => 'required|string|max:1000']);

        Komentar::create([
            'materi_id' => $id,
            'user_id' => auth()->id(),
            'isi' => $request->isi,
        ]);

        return redirect()->route('guru.materi.diskusi', $id)->with('success', 'Komentar berhasil dikirim!');
    }

    // 💬 Simpan balasan komentar
    public function komentar(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:komentars,id',
        ]);

        Komentar::create([
            'materi_id' => $id,
            'user_id' => auth()->id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim.');
    }
}
