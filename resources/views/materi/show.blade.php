@if($materi->file_path)
    <div class="mt-4">
        <h5 class="fw-bold text-secondary">Pratinjau Materi:</h5>
        <iframe src="{{ asset('storage/' . $materi->file_path) }}" width="100%" height="600px" style="border:1px solid #ccc;"></iframe>
    </div>
@endif
<h5 class="mt-5">💬 Diskusi & Komentar</h5>
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="materi_id" value="{{ $materi->id }}">
    <textarea name="content" class="form-control mb-2" rows="3" placeholder="Tulis komentar..." required></textarea>
    <button class="btn btn-primary btn-sm"><i class="bi bi-chat-left-dots"></i> Kirim</button>
</form>

<hr>

@foreach($materi->comments as $comment)
    <div class="mb-3 border-bottom pb-2">
        <strong>{{ $comment->user->name }}</strong><br>
        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
        <p>{{ $comment->content }}</p>
    </div>
@endforeach
