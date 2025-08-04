@extends('guru.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="quiz-card animate__animated animate__fadeInUp">
        <h4 class="fw-bold mb-4"><i class="bi bi-plus-circle me-2"></i>Tambah Soal Kuis</h4>

        {{-- Notifikasi error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong><i class="bi bi-exclamation-triangle-fill"></i> Ups!</strong> Ada kesalahan pada input.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li><i class="bi bi-x-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('guru.kuis.store') }}" method="POST">
            @csrf

            @if (!$jumlah_soal)
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-journal-text me-1"></i>Judul Kuis</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul kuis..." required value="{{ old('judul') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-hash me-1"></i>Jumlah Soal</label>
                    <input type="number" name="jumlah_soal" class="form-control" placeholder="Contoh: 5" min="1" max="50" required value="{{ old('jumlah_soal') }}">
                </div>
            @else
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-journal-text me-1"></i>Judul Kuis</label>
                    <input type="text" class="form-control" value="{{ $judul }}" disabled>
                </div>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill"></i> Soal ke-<strong>{{ $soal_ke }}</strong> dari <strong>{{ $jumlah_soal }}</strong>
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-question-circle me-1"></i>Pertanyaan</label>
                <textarea name="pertanyaan" class="form-control" rows="3" placeholder="Tulis pertanyaan..." required>{{ old('pertanyaan') }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">A. Opsi A</label>
                    <input type="text" name="opsi_a" class="form-control" placeholder="Jawaban A" required value="{{ old('opsi_a') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">B. Opsi B</label>
                    <input type="text" name="opsi_b" class="form-control" placeholder="Jawaban B" required value="{{ old('opsi_b') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">C. Opsi C</label>
                    <input type="text" name="opsi_c" class="form-control" placeholder="Jawaban C" required value="{{ old('opsi_c') }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">D. Opsi D</label>
                    <input type="text" name="opsi_d" class="form-control" placeholder="Jawaban D" required value="{{ old('opsi_d') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="bi bi-check-circle me-1"></i>Jawaban Benar</label>
                <select name="jawaban_benar" class="form-select" required>
                    <option value="">-- Pilih Jawaban --</option>
                    <option value="A" {{ old('jawaban_benar') == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ old('jawaban_benar') == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ old('jawaban_benar') == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ old('jawaban_benar') == 'D' ? 'selected' : '' }}>D</option>
                </select>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mt-4 gap-3">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
                <a href="{{ route('guru.kuis.index') }}" class="btn btn-outline-light text-white border-white">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
