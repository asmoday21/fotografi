@extends('siswa.layouts.app')

@section('content')
<div class="min-vh-100 py-5 px-3" style="background: linear-gradient(to bottom right, #e3f2fd, #ffffff);">
    <div class="container">
        <div class="card border-0 shadow-lg rounded-4 mx-auto p-4 p-md-5" style="max-width: 800px; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px); border: 1px solid #90caf9;">
            
            <!-- Judul -->
            <div class="text-center mb-4">
                <h2 class="fw-bold display-6 text-primary animate__animated animate__fadeInDown">
                    🧠 Pertanyaan Kuis
                </h2>
                <p class="text-dark mt-3 fs-5">{{ $kuis->pertanyaan }}</p>
            </div>

            <!-- Form Pilihan Jawaban -->
            <form action="{{ route('siswa.kuis.submit', $kuis->id) }}" method="POST" class="animate__animated animate__fadeInUp">
                @csrf

                <div class="row g-3">
                    @foreach (['A' => $kuis->opsi_a, 'B' => $kuis->opsi_b, 'C' => $kuis->opsi_c, 'D' => $kuis->opsi_d] as $key => $value)
                        <div class="col-12">
                            <label class="d-flex align-items-center gap-3 bg-light border border-primary-subtle rounded-3 p-3 ps-4 cursor-pointer shadow-sm hover-shadow-lg transition">
                                <input type="radio" name="jawaban" value="{{ $key }}" required class="form-check-input fs-5 me-2 accent-primary">
                                <div class="text-dark fs-6">
                                    <strong>{{ $key }}.</strong> {{ $value }}
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                <!-- Tombol Submit -->
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow animate__animated animate__pulse animate__infinite">
                        ✅ Kirim Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambahan CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
