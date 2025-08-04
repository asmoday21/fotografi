@extends('siswa.layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3 font-bold text-xl">{{ $galeri->judul }}</h2>
    <p class="text-muted mb-4">{{ $galeri->deskripsi }}</p>

    <div class="mb-4">
        @php
            $ext = pathinfo($galeri->file, PATHINFO_EXTENSION);
        @endphp

        @if(in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'webp', 'gif']))
            <img src="{{ asset('storage/' . $galeri->file) }}" class="img-fluid rounded shadow" alt="Karya Siswa">
        @elseif(in_array(strtolower($ext), ['mp4', 'mov', 'webm']))
            <video controls class="w-100 rounded shadow">
                <source src="{{ asset('storage/' . $galeri->file) }}" type="video/{{ $ext }}">
                Browser tidak mendukung video.
            </video>
        @else
            <p class="text-danger">⚠️ Format file tidak didukung untuk ditampilkan langsung.</p>
        @endif
    </div>

    <a href="{{ route('siswa.galeri.index') }}" class="btn btn-secondary">⬅️ Kembali ke Galeri</a>
</div>
@endsection
