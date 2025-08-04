@extends('layouts.guru')
@section('content')
<div class="container">
    <h4>📷 Daftar Kamera 3D</h4>
    <a href="{{ route('guru.kamera3d.create') }}" class="btn btn-info mb-3">+ Tambah Kamera 3D</a>

    @foreach ($kamera3ds as $kamera)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $kamera->judul }}</h5>
                <p>{{ $kamera->deskripsi }}</p>

                <model-viewer 
                    src="{{ asset('storage/kamera3d/' . $kamera->file) }}" 
                    alt="{{ $kamera->judul }}" 
                    auto-rotate 
                    camera-controls 
                    style="width: 100%; height: 400px;">
                </model-viewer>

                <a href="{{ route('guru.kamera3d.edit', $kamera->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form method="POST" action="{{ route('guru.kamera3d.destroy', $kamera->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

{{-- CDN untuk viewer --}}
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endsection
