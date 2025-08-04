@extends('guru.layouts.app')

@section('content')
<h2 class="mb-4">📤 Unggah Karya Siswa</h2>

<form action="{{ route('guru.karyasiswa.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">File Karya (jpg, png, pdf)</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button class="btn btn-primary"><i class="bi bi-upload"></i> Unggah</button>
</form>
@endsection
