@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📝 Tambah Materi</h2>
    <form action="{{ route('guru.materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Upload File (PDF, DOC, PPT, JPG)</label>
            <input type="file" name="file" class="form-control">
        </div>

        <div class="mb-3">
            <label>Ringkasan</label>
            <textarea name="ringkasan" class="form-control" rows="3"></textarea>
        </div>

        <!-- Tambahan input untuk Video Animasi -->
        <div class="mb-3">
            <label>Video Animasi (YouTube URL atau upload MP4)</label>
            <input type="text" name="video_url" class="form-control mb-2" placeholder="Masukkan URL video (opsional)">
            <input type="file" name="video_file" class="form-control" accept="video/mp4">
            <small class="text-muted">Pilih salah satu: URL atau upload file video (MP4)</small>
        </div>

        <div class="mb-3">
            <label>Poin Penting</label>
            <div id="poin-container">
                <input type="text" name="poin_penting[]" class="form-control mb-2" placeholder="Poin 1">
            </div>
            <button type="button" class="btn btn-sm btn-secondary" onclick="addPoin()">+ Tambah Poin</button>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Materi</button>
    </form>
</div>

<script>
    function addPoin() {
        const container = document.getElementById('poin-container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'poin_penting[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'Poin tambahan';
        container.appendChild(input);
    }
</script>
@endsection
