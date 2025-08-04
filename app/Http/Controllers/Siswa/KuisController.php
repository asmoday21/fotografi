<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kuis;
use App\Models\HasilKuis;
use App\Models\JawabanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function index()
    {
        $kuis = Kuis::all();
        return view('siswa.kuis.index', compact('kuis'));
    }

    public function show($id)
    {
        $kuis = Kuis::findOrFail($id);

        $sudahMengerjakan = HasilKuis::where('user_id', Auth::id())
            ->where('kuis_id', $id)
            ->exists();

        if ($sudahMengerjakan) {
            return redirect()->route('siswa.kuis.index')->with('error', '⚠️ Anda sudah mengerjakan kuis ini.');
        }

        return view('siswa.kuis.show', compact('kuis'));
    }

    public function kerjakan($judul)
    {
        $soal = Kuis::where('judul', $judul)->get();

        if ($soal->isEmpty()) {
            return redirect()->back()->with('error', 'Soal tidak ditemukan.');
        }

        $userId = Auth::id();
        $kuis_id = $soal->first()->id;

        $sudahMengerjakan = HasilKuis::where('user_id', $userId)
            ->where('kuis_id', $kuis_id)
            ->exists();

        if ($sudahMengerjakan) {
            return redirect()->route('siswa.kuis.index')->with('error', '⚠️ Kamu sudah mengerjakan kuis ini.');
        }

        return view('siswa.kuis.kerjakan', compact('soal', 'judul'));
    }

    public function submitKerjakan(Request $request, $judul)
    {
        $soal = Kuis::where('judul', $judul)->get();
        $userId = Auth::id();

        if ($soal->isEmpty()) {
            return redirect()->back()->with('error', 'Soal tidak ditemukan.');
        }

        $kuis_id = $soal->first()->id;

        $sudah = HasilKuis::where('user_id', $userId)
            ->where('kuis_id', $kuis_id)
            ->exists();

        if ($sudah) {
            return redirect()->route('siswa.kuis.index')
                ->with('error', '⚠️ Kuis sudah pernah dikerjakan.');
        }

        $jawabanUser = $request->input('jawaban');
        $jumlahSoal = count($soal);
        $jumlahBenar = 0;

        foreach ($soal as $item) {
            $jawaban = $jawabanUser[$item->id] ?? null;
            $benar = $jawaban === $item->jawaban_benar;
            if ($benar) $jumlahBenar++;

            JawabanSiswa::create([
                'user_id' => $userId,
                'kuis_id' => $item->id,
                'jawaban' => $jawaban,
                'benar' => $benar,
            ]);
        }

        $skorAkhir = round(($jumlahBenar / $jumlahSoal) * 100);

        HasilKuis::create([
            'user_id' => $userId,
            'kuis_id' => $kuis_id,
            'nilai' => $skorAkhir,
        ]);

        return redirect()->route('siswa.kuis.index')
            ->with('success', "✅ Kuis selesai! Nilai kamu: $skorAkhir");
    }

    public function submitKuis(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'jawaban' => 'required|array',
        ]);

        $userId = Auth::id();
        $jawabanSiswa = $request->jawaban;

        $nilai = 0;
        $jumlah = count($jawabanSiswa);

        foreach ($jawabanSiswa as $idSoal => $jawaban) {
            $soal = Kuis::find($idSoal);
            $benar = $soal->jawaban_benar === $jawaban;
            if ($benar) $nilai++;

            JawabanSiswa::create([
                'user_id' => $userId,
                'kuis_id' => $idSoal,
                'jawaban' => $jawaban,
                'benar' => $benar,
            ]);
        }

        $nilaiAkhir = $jumlah > 0 ? ($nilai / $jumlah) * 100 : 0;
        $kuis_id = array_key_first($jawabanSiswa);

        HasilKuis::create([
            'user_id' => $userId,
            'kuis_id' => $kuis_id,
            'nilai' => $nilaiAkhir,
        ]);

        return redirect()->route('siswa.kuis.index')
            ->with('success', '✅ Kuis selesai. Nilai akhir kamu: ' . $nilaiAkhir);
    }
}
