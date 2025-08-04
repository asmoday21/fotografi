@extends('siswa.layouts.app')

@section('content')
<div class="min-vh-100 py-5 px-3" style="background: linear-gradient(135deg, #e0f2fe, #fef9ff);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary display-6 animate__animated animate__fadeInDown">
                <i class="bi bi-stars text-info me-2"></i> Kuis Interaktif
            </h2>
            <p class="text-muted animate__animated animate__fadeInUp">Klik tombol untuk mulai mengerjakan kuis. Anda hanya bisa mengerjakan 1 kali.</p>
        </div>

        @php
            $grouped = $kuis->groupBy('judul');
        @endphp

        <div class="row g-4">
            @foreach($grouped as $judul => $items)
                @php
                    $kuis_id = $items->first()->id;
                    $sudah = \App\Models\HasilKuis::where('user_id', auth()->id())
                        ->where('kuis_id', $kuis_id)
                        ->exists();
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 bg-white position-relative overflow-hidden kuis-card">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <div>
                                <h5 class="text-center text-gradient fw-bold mb-2">{{ $judul }}</h5>
                                <p class="text-center small text-muted mb-0">{{ $items->count() }} soal pilihan ganda</p>
                            </div>

                            <div class="text-center mt-4">
                                @if(!$sudah)
                                    <a href="{{ route('siswa.kuis.kerjakan', $judul) }}" class="btn btn-success w-100 rounded-pill shadow-sm">
                                        <i class="bi bi-play-circle me-1"></i> Mulai Kuis
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100 rounded-pill shadow-sm" disabled>
                                        <i class="bi bi-check-circle me-1"></i> Sudah Dikerjakan
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="kuis-decor"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('head')
<style>
    .text-gradient {
        background: linear-gradient(to right, #0ea5e9, #6366f1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .kuis-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .kuis-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 36px rgba(0, 0, 0, 0.1);
    }

    .kuis-decor {
        position: absolute;
        top: -40px;
        right: -40px;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle at center, #0ea5e9, transparent 60%);
        opacity: 0.15;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .card-body {
        position: relative;
        z-index: 1;
    }
</style>
@endsection
