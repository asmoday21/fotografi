{{-- resources/views/admin/objek3d/edit.blade.php --}}
@extends('admin.layouts.admin')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning text-dark rounded-top-4">
            <h4 class="mb-0 fw-bold">🛠️ Edit Objek 3D</h4>
        </div>

        <div class="card-body bg-light">
            {{-- Tampilkan pesan error --}}
            @if($errors->any())
                <div class="alert alert-danger rounded-3 shadow-sm">
                    <strong>⚠️ Terjadi Kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.objek3d.update', $objek3d->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold">📌 Judul Objek</label>
                    <input type="text" name="judul" id="judul"
                           class="form-control rounded-3 @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $objek3d->judul) }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="mb-4">
                    <label for="deskripsi" class="form-label fw-semibold">📝 Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                              class="form-control rounded-3 @error('deskripsi') is-invalid @enderror"
                              placeholder="Tulis deskripsi singkat...">{{ old('deskripsi', $objek3d->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- File Upload --}}
                <div class="mb-4">
                    <label for="file" class="form-label fw-semibold">📂 Ganti File (.glb, .gltf, .obj, .jpg, .jpeg, .png)</label>
                    <input type="file" name="file" id="file"
                           class="form-control rounded-3 @error('file') is-invalid @enderror"
                           accept=".glb,.gltf,.obj,.jpg,.jpeg,.png">
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($objek3d->file)
                        <small class="text-muted d-block mt-2">📎 File saat ini: <strong>{{ basename($objek3d->file) }}</strong></small>
                    @endif
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.objek3d.index') }}" class="btn btn-secondary px-4 fw-semibold rounded-3 shadow-sm">
                        🔙 Kembali
                    </a>
                    <button type="submit" class="btn btn-success px-4 fw-semibold rounded-3 shadow-sm">
                        💾 Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    input:focus, textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.2);
}

.card:hover {
    transition: all 0.3s ease;
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.1);
}

</style>
@endsection
