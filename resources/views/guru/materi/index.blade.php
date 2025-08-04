@extends('guru.layouts.app')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📚 Daftar Materi</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('guru.materi.create') }}" class="btn btn-primary mb-4">➕ Tambah Materi</a>

    <div class="row">
        @forelse($materi as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 animate__animated animate__fadeInUp animate__faster">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary">{{ $item->judul }}</h5>
                    <p class="card-text text-muted">{{ $item->deskripsi }}</p>

                    {{-- Ringkasan --}}
                    @if($item->ringkasan)
                    <div class="mt-2 animate__animated animate__fadeInUp animate__delay-1s">
                        <strong>📌 Ringkasan:</strong>
                        <p class="text-dark">{{ $item->ringkasan }}</p>
                    </div>
                    @endif

                                        {{-- Video Animasi --}}
@if($item->video_url || $item->video_path)
    <div class="mt-2 animate__animated animate__fadeInUp animate__delay-3s">
        <strong>🎞️ Video Animasi Ringkasan:</strong>
        
        {{-- Video dari URL --}}
        @if($item->video_url)
            <div class="ratio ratio-16x9 mb-2">
                <iframe src="{{ $item->video_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        {{-- Video yang diupload --}}
        @if($item->video_path && Storage::disk('public')->exists($item->video_path))
            <video controls width="100%" class="rounded shadow-sm mb-2">
                <source src="{{ asset('storage/' . $item->video_path) }}" type="video/mp4">
                Browser Anda tidak mendukung video.
            </video>
        @endif
    </div>
@endif

                    {{-- Poin Penting --}}
                    @if($item->poin_penting)
                    <div class="mt-2 animate__animated animate__fadeInUp animate__delay-2s">
                        <strong>✅ Poin Penting:</strong>
                        <ul class="text-dark">
                            @foreach(is_array($item->poin_penting) ? $item->poin_penting : json_decode($item->poin_penting, true) as $poin)
                                <li>{{ trim($poin) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif



                    {{-- File --}}
                    @if($item->file_path && Storage::disk('public')->exists($item->file_path))
                        <button class="btn btn-sm btn-outline-primary mt-auto" data-bs-toggle="modal" data-bs-target="#modalFile{{ $item->id }}">
                            📎 Lihat File
                        </button>
                    @else
                        <span class="text-danger mt-auto">❌ File tidak ditemukan</span>
                    @endif

                    {{-- Aksi --}}
                    <div class="mt-3">
                        <a href="{{ route('guru.materi.edit', $item->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <a href="{{ route('guru.materi.diskusi', $item->id) }}" class="btn btn-sm btn-outline-info">💬 Diskusi</a>
                        <form action="{{ route('guru.materi.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus materi ini?')">🗑️</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Preview File -->
        <div class="modal fade" id="modalFile{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel{{ $item->id }}">📎 File Materi: {{ $item->judul }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        @php
                            $fileUrl = asset('storage/' . $item->file_path);
                            $ext = pathinfo($item->file_path, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array($ext, ['pdf']))
                            <iframe src="{{ $fileUrl }}" width="100%" height="500px"></iframe>
                        @elseif(in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ $fileUrl }}" class="img-fluid rounded" alt="Preview Gambar">
                        @else
                            <p>File: <a href="{{ $fileUrl }}" target="_blank">{{ basename($item->file_path) }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Belum ada materi tersedia.</div>
        </div>
        @endforelse
    </div>
</div>
@endsection
