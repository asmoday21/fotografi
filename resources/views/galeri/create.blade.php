@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Upload Karya</h2>

    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>File Gambar</label>
            <input type="file" name="file" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-success">Unggah Karya</button>
    </form>
</div>
@endsection
