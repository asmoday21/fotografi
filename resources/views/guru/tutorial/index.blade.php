@extends('guru.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🎥 Video Tutorial</h1>

    <a href="{{ route('guru.tutorial.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-upload"></i> Upload Video
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse ($tutorials as $video)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100">
                    <video controls style="width: 100%; height: auto;">
                        <source src="{{ asset('storage/' . $video->file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->judul }}</h5>
                        <p class="card-text">{{ $video->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada video tutorial yang diupload.</p>
        @endforelse
    </div>
</div>
@endsection
