@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header bg-primary bg-gradient text-white rounded-top-4">
            <h5 class="mb-0 fw-bold">
                {{ isset($galeri) ? '✏️ Edit Karya Siswa' : '🎨 Tambah Karya Siswa' }}
            </h5>
        </div>

        <div class="card-body p-4 bg-light">
            <form method="POST" action="{{ isset($galeri) ? route('admin.galeri.update', $galeri->id) : route('galeri.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($galeri)) @method('PUT') @endif

                <div class="mb-4">
                    <label for="user_id" class="form-label fw-semibold">👤 Nama Siswa</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ isset($galeri) && $galeri->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">🖋️ Judul Karya</label>
                    <input type="text" name="judul" class="form-control rounded-3" value="{{ $galeri->judul ?? '' }}" required placeholder="Masukkan judul karya...">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">📝 Deskripsi</label>
                    <textarea name="deskripsi" class="form-control rounded-3" rows="4" required placeholder="Tulis deskripsi singkat...">{{ $galeri->deskripsi ?? '' }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">📎 Upload File (Gambar, Video, PDF)</label>
                    <input type="file" name="file" class="form-control rounded-3" {{ isset($galeri) ? '' : 'required' }}>
                    @if(isset($galeri))
                        <small class="text-muted d-block mt-2">📁 File sebelumnya: {{ $galeri->file }}</small>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-success px-4 py-2 rounded-3 fw-semibold shadow-sm">
                        💾 Simpan {{ isset($galeri) ? 'Perubahan' : 'Karya' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
