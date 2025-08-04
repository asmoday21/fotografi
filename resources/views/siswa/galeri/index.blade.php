<!-- resources/views/siswa/galeri/index.blade.php -->
@extends('siswa.layouts.app')

@section('title', 'Galeri Karya Siswa')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Galeri Karya</h1>

    @if ($galeri->isEmpty())
        <p>Belum ada karya yang diupload.</p>
    @else
        <div class="row">
            @foreach ($galeri as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if (Str::endsWith($item->file, ['.jpg', '.jpeg', '.png', '.gif']))
                            <img src="{{ asset('storage/' . $item->file) }}" class="card-img-top" alt="{{ $item->judul }}">
                        @elseif (Str::endsWith($item->file, ['.mp4', '.mov', '.webm']))
                            <video class="card-img-top" controls>
                                <source src="{{ asset('storage/' . $item->file) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
