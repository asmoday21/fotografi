@extends('guru.layouts.app')

@section('content')
<h2 class="mb-4">🖼️ Karya Siswa</h2>

<a href="{{ route('guru.karyasiswa.create') }}" class="btn btn-success mb-3">
    <i class="bi bi-plus-circle"></i> Tambah Karya
</a>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
@forelse ($karya as $item)
    <div class="col-md-4 mb-4">
        <div class="card shadow">
            <img src="{{ asset('storage/' . $item->file) }}" class="card-img-top" alt="{{ $item->judul }}">
            <div class="card-body">
                <h5>{{ $item->judul }}</h5>
                <p>{{ $item->deskripsi }}</p>
                <form action="{{ route('guru.karyasiswa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus karya ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p>Tidak ada karya siswa.</p>
@endforelse
</div>
@endsection
