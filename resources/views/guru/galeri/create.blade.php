@extends('guru.layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Karya Siswa</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('guru.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">👤 Nama Siswa</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">🖋️ Judul Karya</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">📄 Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">📁 File Karya (jpg, mp4, pdf, png)</label>
                    <input type="file" name="file" class="form-control" required accept=".jpg,.jpeg,.png,.mp4,.pdf,.glb">
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-pill fw-semibold">💾 Simpan Karya</button>
            </form>
        </div>
    </div>
</div>
@endsection
