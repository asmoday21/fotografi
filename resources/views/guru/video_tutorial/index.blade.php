@extends('guru.layouts.app')

@section('content')
<style>
    .video-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: 0.3s ease-in-out;
    }

    .video-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    }

    .video-title {
        font-weight: 700;
        color: #2c3e50;
    }

    .video-meta {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .video-actions .btn {
        margin-right: 5px;
        border-radius: 30px;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">🎥 Video Tutorial Saya</h1>
        <a href="{{ route('guru.video-tutorial.create') }}" class="btn btn-primary rounded-pill">➕ Tambah Video</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-pill px-4 py-2">{{ session('success') }}</div>
    @endif

    @if($videos->count() > 0)
        <div class="row g-4">
            @foreach($videos as $video)
            <div class="col-md-6 col-lg-4">
                <div class="video-card p-3 h-100 d-flex flex-column justify-content-between">
                    <div>
                        {{-- Tampilkan video dari file upload --}}
                        @if($video->file_path)
                            <video width="100%" height="auto" controls class="mb-3 rounded">
                                <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung video.
                            </video>
                        @else
                            {{-- Cek dan tampilkan video YouTube --}}
                            @php
                                $videoId = null;
                                $parsedUrl = parse_url($video->url);
                                if (isset($parsedUrl['query'])) {
                                    parse_str($parsedUrl['query'], $query);
                                    $videoId = $query['v'] ?? null;
                                } elseif (str_contains($video->url, 'youtu.be/')) {
                                    $parts = explode('/', $video->url);
                                    $videoId = end($parts);
                                }
                            @endphp

                            @if($videoId)
                                <div class="ratio ratio-16x9 rounded mb-3">
                                    <iframe 
                                        src="https://www.youtube.com/embed/{{ $videoId }}" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @else
                                <div class="alert alert-warning small">⚠️ URL video tidak valid.</div>
                            @endif
                        @endif

                        <h5 class="video-title">{{ $video->judul }}</h5>
                        <p class="text-muted small mb-2">{{ Str::limit($video->deskripsi, 100) }}</p>
                        <p class="video-meta">📅 {{ $video->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="video-actions mt-2">
                        <a href="{{ route('guru.video-tutorial.edit', $video->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('guru.video-tutorial.destroy', $video->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $videos->links() }}
        </div>
    @else
        <div class="text-center text-muted mt-5">
            <p>📭 Belum ada video tutorial yang ditambahkan.</p>
        </div>
    @endif
</div>
@endsection
