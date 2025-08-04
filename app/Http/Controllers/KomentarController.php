<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\KomentarBaruNotification;

class KomentarController extends Controller
{
    /**
     * Menampilkan semua komentar untuk admin
     */
    public function index()
    {
        $komentar = Comment::with(['user', 'replies.user', 'materi'])
            ->whereNull('parent_id')
            ->latest()
            ->get();

        return view('admin.komentar.index', compact('komentar'));
    }

    /**
     * Menyimpan komentar utama atau balasan (bisa oleh admin/guru/siswa)
     */
   public function store(Request $request)
{
    $request->validate([
        'materi_id' => 'required|exists:materi,id',
        'content'   => 'required|string|min:1',
        'parent_id' => 'nullable|exists:comments,id',
    ]);

    // Cek apakah user login
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengirim komentar.');
    }

    // ✅ Simpan komentar dan ambil hasilnya
    $comment = Comment::create([
        'materi_id' => $request->materi_id,
        'user_id'   => Auth::id(),
        'content'   => $request->content,
        'parent_id' => $request->parent_id,
    ]);

    // 🔔 Kirim notifikasi ke semua user kecuali pengirim
    $users = User::where('id', '!=', auth()->id())->get();
    foreach ($users as $user) {
        $user->notify(new KomentarBaruNotification($comment));
    }

    return back()->with('success', '✅ Komentar berhasil dikirim!');
}

    /**
     * Khusus balasan dari admin (bisa juga pakai store() dengan parent_id)
     */
    public function balas(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|min:1',
        ]);

        $komentarInduk = Comment::findOrFail($id);

        Comment::create([
            'materi_id' => $komentarInduk->materi_id,
            'user_id'   => Auth::id(),
            'content'   => $request->content,
            'parent_id' => $komentarInduk->id,
        ]);

// Ambil komentar induk yang dibalas
// $parent = Comment::findOrFail($request->parent_id);
          // 🔔 Kirim notifikasi ke pemilik komentar utama
    // if ($parent->user_id != auth()->id()) {
    //     $parent->user->notify(new KomentarBaruNotification($balasan));
    // }

        return back()->with('success', '✅ Balasan berhasil dikirim.');
    }
}
