@extends('guru.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Upload Video Tutorial</h4>

    <form action="{{ route('guru.tutorial.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul Tutorial</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi (opsional)</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Upload Video (mp4, mov, avi, wmv)</label>
            <input type="file" name="file" id="file" class="form-control" accept="video/*" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Upload Video</button>
    </form>
</div>
@endsection
