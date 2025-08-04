@extends('guru.layouts.app')

@section('content')
<h4 class="mb-4 fw-bold">✏️ Edit Judul Kuis</h4>

<form action="{{ route('guru.kuis.updatejudul', $judul) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="judul_baru" class="form-label">Judul Baru</label>
        <input type="text" name="judul_baru" id="judul_baru" class="form-control" value="{{ $judul }}" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('guru.kuis.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
