@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Upload Objek 3D</h3>
    <form method="POST" action="{{ route('kamera3d.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>File (.glb / .gltf)</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
