@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Objek 3D</h3>
    <a href="{{ route('kamera3d.create') }}" class="btn btn-primary mb-3">Upload Baru</a>
    <div class="row">
        @foreach($items as $item)
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->judul }}</h5>
                    <p>{{ Str::limit($item->deskripsi, 100) }}</p>
                    <a href="{{ route('kamera3d.show', $item->id) }}" class="btn btn-sm btn-outline-success">Lihat 3D</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
