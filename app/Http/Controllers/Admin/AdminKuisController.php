<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kuis;

class AdminKuisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // ⬅️ Penting! Agar auth()->id() bisa digunakan
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string',
            'opsi_b' => 'required|string',
            'opsi_c' => 'required|string',
            'opsi_d' => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d',
        ]);

        Kuis::create([
            'pertanyaan' => $request->pertanyaan,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
            'user_id' => auth()->id(), // ⬅️ Ambil ID user yang login
        ]);

        return redirect()->route('admin.kuis.index')->with('success', 'Soal berhasil ditambahkan!');
    }
}
