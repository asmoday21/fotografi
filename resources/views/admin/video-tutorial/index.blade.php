@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.video-tutorial.create') }}" class="btn btn-success shadow-sm fw-semibold rounded-3">
            + Tambah Video
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @forelse($videos as $video)
        @php
            // Ekstrak ID video YouTube dari URL
            $videoId = null;
            $parsed = parse_url($video->url);
            if (isset($parsed['query'])) {
                parse_str($parsed['query'], $queryParams);
                $videoId = $queryParams['v'] ?? null;
            } elseif (str_contains($video->url, 'youtu.be/')) {
                $videoId = basename($parsed['path']);
            }
        @endphp

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100 border-0 rounded-4">
                <div class="ratio ratio-16x9 rounded-top-4 overflow-hidden">
                    @if($videoId)
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $videoId }}" 
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    @else
                    <div class="text-danger p-3">⚠️ URL video tidak valid</div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-dark fw-bold">{{ $video->judul }}</h5>
                    <p class="card-text text-secondary mb-3">{{ Str::limit($video->deskripsi, 100) }}</p>
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('admin.video-tutorial.edit', $video->id) }}" class="btn btn-warning btn-sm w-50 fw-semibold">✏️ Edit</a>
                        <form action="{{ route('admin.video-tutorial.destroy', $video->id) }}" method="POST" class="w-50"
                            onsubmit="return confirm('Yakin ingin menghapus video ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm w-100 fw-semibold">🗑️ Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                📭 Belum ada video tutorial yang ditambahkan.
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-5px);
        transition: all 0.3s ease;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .card-title {
        font-size: 1.1rem;
    }

    .btn {
        transition: 0.2s ease-in-out;
    }
</style>
@endsection
