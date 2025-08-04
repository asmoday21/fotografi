@extends('layouts.guru')
@section('content')
<div class="container">
    <h4>✏️ Edit Kamera 3D</h4>
    <form method="POST" action="{{ route('guru.kamera3d.update', $kamera3d->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $kamera3d->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $kamera3d->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>File 3D Baru (Opsional)</label>
            <input type="file" name="file" class="form-control">
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
