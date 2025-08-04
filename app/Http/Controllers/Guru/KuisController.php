<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kuis;

class KuisController extends Controller
{
    public function index()
    {
      $kuis = Kuis::where('user_id', Auth::id())
    ->whereNotNull('judul')
    ->where('judul', '!=', '')
    ->get();

        return view('guru.kuis.index', compact('kuis'));
    }

    public function create()
    {
        $jumlah_soal = session('jumlah_soal', null);
        $soal_ke     = session('soal_ke', 1);
        $judul       = session('judul_kuis', '');

        return view('guru.kuis.create', compact('jumlah_soal', 'soal_ke', 'judul'));
    }

    public function store(Request $request)
    {
        $is_soal_pertama = !session()->has('jumlah_soal');

        $rules = [
            'pertanyaan'      => 'required|string|max:255',
            'opsi_a'          => 'required|string|max:100',
            'opsi_b'          => 'required|string|max:100',
            'opsi_c'          => 'required|string|max:100',
            'opsi_d'          => 'required|string|max:100',
            'jawaban_benar'   => 'required|in:A,B,C,D',
        ];

        if ($is_soal_pertama) {
            $rules['judul'] = 'required|string|max:255';
            $rules['jumlah_soal'] = 'required|integer|min:1|max:50';
        }

        $request->validate($rules);

        if ($is_soal_pertama) {
            session([
                'judul_kuis'  => $request->judul,
                'jumlah_soal' => $request->jumlah_soal,
                'soal_ke'     => 1,
            ]);
        }

        Kuis::create([
            'judul'         => session('judul_kuis'),
            'pertanyaan'    => $request->pertanyaan,
            'opsi_a'        => $request->opsi_a,
            'opsi_b'        => $request->opsi_b,
            'opsi_c'        => $request->opsi_c,
            'opsi_d'        => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'user_id'       => Auth::id(),
        ]);

        session(['soal_ke' => session('soal_ke') + 1]);

        if (session('soal_ke') <= session('jumlah_soal')) {
            return redirect()->route('guru.kuis.create')
                ->with('success', '✅ Soal ke-' . (session('soal_ke') - 1) . ' disimpan. Lanjutkan input berikutnya...');
        } else {
            session()->forget(['jumlah_soal', 'soal_ke', 'judul_kuis']);
            return redirect()->route('guru.kuis.index')
                ->with('success', '🎉 Semua soal berhasil ditambahkan.');
        }
    }

    public function edit($id)
    {
        $kuis = Kuis::findOrFail($id);

        if ($kuis->user_id !== Auth::id()) {
            return redirect()->route('guru.kuis.index')->with('error', '⛔ Akses ditolak.');
        }

        return view('guru.kuis.edit', compact('kuis'));
    }

    public function update(Request $request, $id)
    {
        $kuis = Kuis::findOrFail($id);

        if ($kuis->user_id !== Auth::id()) {
            return redirect()->route('guru.kuis.index')->with('error', '⛔ Tidak diizinkan!');
        }

        $request->validate([
            'pertanyaan'      => 'required|string|max:255',
            'opsi_a'          => 'required|string|max:100',
            'opsi_b'          => 'required|string|max:100',
            'opsi_c'          => 'required|string|max:100',
            'opsi_d'          => 'required|string|max:100',
            'jawaban_benar'   => 'required|in:A,B,C,D',
        ]);

        $kuis->update($request->only(['pertanyaan', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'jawaban_benar']));

        return redirect()->route('guru.kuis.index')->with('success', '✅ Kuis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kuis = Kuis::findOrFail($id);

        if ($kuis->user_id !== Auth::id()) {
            abort(403, '⛔ Anda tidak diizinkan menghapus kuis ini.');
        }

        $kuis->delete();

        return redirect()->route('guru.kuis.index')->with('success', '🗑️ Kuis berhasil dihapus.');
    }

    public function destroyByJudul($judul)
    {
        // Decode judul (karena tadi kita encode di blade pakai urlencode)
        $judul = urldecode($judul);

        // Validasi kepemilikan kuis
        $kuis = Kuis::where('judul', $judul)->where('user_id', Auth::id());

        if (!$kuis->exists()) {
            return redirect()->route('guru.kuis.index')->with('error', '⛔ Kuis tidak ditemukan atau bukan milik Anda.');
        }

        $kuis->delete();

        return redirect()->route('guru.kuis.index')->with('success', '🗑️ Semua soal dengan judul "' . $judul . '" telah dihapus.');
    }
}
