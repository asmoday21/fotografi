@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Galeri Karya Siswa</h2>

    <div class="row">
        @foreach ($galeri as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <img src="{{ asset('storage/' . $item->file) }}" class="card-img-top" alt="Karya">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p class="card-text">{{ $item->deskripsi }}</p>
                    <small class="text-muted">Oleh: {{ $item->user->name }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
