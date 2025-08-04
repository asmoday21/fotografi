@csrf
<div class="mb-3">
    <label for="judul" class="form-label">Judul Materi</label>
    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $materi->judul ?? '') }}" required>
    @error('judul')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi Materi</label>
    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $materi->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="file" class="form-label">Upload File (Opsional)</label>
    <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file" accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.png">
    @error('file')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @if(!empty($materi->file))
        <small class="form-text text-muted mt-1">
            File saat ini: <a href="{{ asset('storage/materi/' . $materi->file) }}" target="_blank">{{ $materi->file }}</a>
        </small>
    @endif
</div>
