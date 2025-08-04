@extends('admin.layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="form-box p-4 rounded-4 shadow-lg bg-white bg-opacity-75">
        <h4 class="mb-4 fw-bold text-primary">
            {{ isset($galeri) ? '✏️ Edit Karya Siswa' : '🎨 Tambah Karya Siswa' }}
        </h4>

        <form action="{{ isset($galeri) ? route('admin.galeri.update', $galeri->id) : route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($galeri)) @method('PUT') @endif

            <div class="mb-3">
                <label for="user_id" class="form-label">👤 Nama Siswa</label>
                <select name="user_id" class="form-select form-select-lg rounded-3 shadow-sm" required>
                    <option value="">-- Pilih Siswa --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ isset($galeri) && $galeri->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">📝 Judul Karya</label>
                <input type="text" name="judul" class="form-control form-control-lg rounded-3 shadow-sm" value="{{ $galeri->judul ?? '' }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">📖 Deskripsi</label>
                <textarea name="deskripsi" class="form-control form-control-lg rounded-3 shadow-sm" rows="4" required>{{ $galeri->deskripsi ?? '' }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">📁 File (jpg, png, mp4, pdf, glb)</label>
                <input type="file" name="file" class="form-control form-control-lg rounded-3 shadow-sm"
                       accept=".jpg,.jpeg,.png,.mp4,.pdf,.glb"
                       {{ isset($galeri) ? '' : 'required' }}>

                @if(isset($galeri) && $galeri->file)
                    <small class="text-muted d-block mt-2">📌 File sebelumnya: {{ $galeri->file }}</small>
                    @php $ext = pathinfo($galeri->file, PATHINFO_EXTENSION); @endphp

                    <div class="mt-3">
                        @if($ext === 'glb')
                            <model-viewer src="{{ asset('storage/' . $galeri->file) }}"
                                          alt="3D Model"
                                          auto-rotate
                                          camera-controls
                                          style="width: 100%; height: 300px; background: #eee;">
                            </model-viewer>
                        @elseif(in_array($ext, ['jpg', 'jpeg', 'png']))
                            <img src="{{ asset('storage/' . $galeri->file) }}" class="img-fluid rounded-3 shadow-sm">
                        @elseif($ext === 'mp4')
                            <video controls class="w-100 rounded-3 shadow-sm">
                                <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                            </video>
                        @elseif($ext === 'pdf')
                            <embed src="{{ asset('storage/' . $galeri->file) }}" type="application/pdf" width="100%" height="300px" class="rounded-3 shadow-sm">
                        @endif
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-gradient w-100 py-2 mt-3 fw-semibold">
                💾 Simpan Karya
            </button>
        </form>
    </div>
</div>

{{-- CSS Style --}}
<style>
.form-box {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(8px);
    animation: fadeSlide 0.5s ease-in-out;
}

.btn-gradient {
    background: linear-gradient(135deg, #6f42c1, #d63384);
    color: #fff;
    border: none;
    border-radius: 50px;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: scale(1.03);
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.25);
}

@keyframes fadeSlide {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

{{-- Script --}}
@push('scripts')
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endpush
@endsection
