@extends('guru.layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">✏️ Edit Karya Siswa</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('guru.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">👤 Nama Siswa</label>
                    <select name="user_id" class="form-select" required>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $galeri->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">🖋️ Judul Karya</label>
                    <input type="text" name="judul" class="form-control" value="{{ $galeri->judul }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">📖 Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $galeri->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">📁 File (kosongkan jika tidak ingin mengganti)</label>
                    <input type="file" name="file" class="form-control">

                    @if($galeri->file)
                        <small class="text-muted d-block mt-2">📎 File saat ini: {{ $galeri->file }}</small>
                    @endif
                </div>

                <button type="submit" class="btn btn-success w-100">💾 Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
