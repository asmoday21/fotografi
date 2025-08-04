@extends('guru.layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">✏️ Edit Materi</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada beberapa kesalahan dalam input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Materi</label>
            <input type="text" class="form-control" name="judul" value="{{ old('judul', $materi->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $materi->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Ganti File (opsional)</label>
            <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.jpeg,.png">
            @if($materi->file_path)
                <small class="text-muted">File saat ini: 
                    <a href="{{ asset('storage/'.$materi->file_path) }}" target="_blank">📎 Lihat File</a>
                </small>
            @endif
        </div>

        <div class="mb-3">
            <label for="ringkasan" class="form-label">Ringkasan</label>
            <textarea name="ringkasan" class="form-control" rows="3">{{ old('ringkasan', $materi->ringkasan) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="poin_penting" class="form-label">Poin Penting</label>
            <div id="poin-container">
                @php
                    $poinPenting = is_array($materi->poin_penting) 
                        ? $materi->poin_penting 
                        : json_decode($materi->poin_penting, true);
                @endphp

                @if($poinPenting)
                    @foreach($poinPenting as $i => $poin)
                        <input type="text" name="poin_penting[]" class="form-control mb-2" value="{{ $poin }}" placeholder="Poin {{ $i+1 }}">
                    @endforeach
                @else
                    <input type="text" name="poin_penting[]" class="form-control mb-2" placeholder="Poin 1">
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-secondary mt-1" onclick="addPoin()">+ Tambah Poin</button>
        </div>

        <div class="mb-3">
            <label for="video_url" class="form-label">URL Video (opsional)</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $materi->video_url) }}" placeholder="https://youtube.com/...">
        </div>

        <div class="mb-3">
            <label for="video_file" class="form-label">Upload Video (opsional)</label>
            <input type="file" name="video_file" class="form-control" accept="video/mp4">
            @if($materi->video_path)
                <small class="text-muted">Video saat ini: 
                    <a href="{{ asset('storage/'.$materi->video_path) }}" target="_blank">🎞️ Lihat Video</a>
                </small>
            @endif
        </div>

        <button type="submit" class="btn btn-success">💾 Update Materi</button>
        <a href="{{ route('guru.materi.index') }}" class="btn btn-secondary">Kembali</a>
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
