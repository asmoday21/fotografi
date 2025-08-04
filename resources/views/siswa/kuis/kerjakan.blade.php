@extends('siswa.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">📝 Kerjakan Kuis: {{ $judul }}</h4>

    <form action="{{ route('siswa.kuis.submit', $judul) }}" method="POST">
        @csrf

        @foreach ($soal as $index => $s)
            <div class="mb-4 border rounded p-3 bg-white shadow-sm">
                <strong>{{ $index + 1 }}. {{ $s->pertanyaan }}</strong>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="jawaban[{{ $s->id }}]" value="A" required>
                    <label class="form-check-label">A. {{ $s->opsi_a }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban[{{ $s->id }}]" value="B" required>
                    <label class="form-check-label">B. {{ $s->opsi_b }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban[{{ $s->id }}]" value="C" required>
                    <label class="form-check-label">C. {{ $s->opsi_c }}</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban[{{ $s->id }}]" value="D" required>
                    <label class="form-check-label">D. {{ $s->opsi_d }}</label>
                </div>
            </div>
        @endforeach

        <button type="submit" class="btn btn-success">✅ Selesai & Kirim Jawaban</button>
    </form>
</div>
@endsection
