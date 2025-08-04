@extends('guru.layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h3 class="mb-3">📘 Detail Materi</h3>

        {{-- Judul --}}
        <h4 class="fw-bold">{{ $materi->judul }}</h4>

        {{-- Deskripsi --}}
        <p class="text-muted mb-3">
            {{ $materi->deskripsi }}
        </p>

        {{-- File Materi --}}
        @if ($materi->file)
            <div class="mb-3">
                <h5>📎 File Materi</h5>
                @php
                    $ext = pathinfo($materi->file, PATHINFO_EXTENSION);
                    $url = asset('storage/materi/' . $materi->file);
                @endphp

                @if(in_array($ext, ['pdf']))
                    <iframe src="{{ $url }}" width="100%" height="500px" class="border rounded"></iframe>
                    <div class="mt-2">
                        <a href="{{ $url }}" target="_blank" class="btn btn-outline-primary btn-sm">🔗 Lihat / Unduh PDF</a>
                    </div>
                @elseif(in_array($ext, ['doc', 'docx', 'zip']))
                    <div>
                        <a href="{{ $url }}" target="_blank" class="btn btn-outline-secondary">⬇️ Unduh File {{ strtoupper($ext) }}</a>
                    </div>
                @else
                    <p class="text-danger">⚠️ Format file tidak dikenali: {{ $ext }}</p>
                @endif
            </div>
        @endif

        {{-- Ringkasan --}}
        @if ($materi->ringkasan)
            <div class="mt-4">
                <h5>📝 Ringkasan</h5>
                <p>{{ $materi->ringkasan }}</p>
            </div>
        @endif

        {{-- Poin Penting --}}
        @if (!empty($materi->poin_penting))
            <div class="mt-4">
                <h5>🔍 Poin Penting</h5>
                <ul>
                    @foreach ($materi->poin_penting as $poin)
                        <li>{{ $poin }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tombol Kembali --}}
        <div class="mt-4">
            <a href="{{ route('guru.materi.index') }}" class="btn btn-secondary">⬅️ Kembali ke Daftar Materi</a>
        </div>
    </div>
</div>
@endsection
