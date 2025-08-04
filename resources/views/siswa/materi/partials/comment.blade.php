<div class="card mb-2">
  <div class="card-body">
    <strong>{{ $comment->user->name }}</strong>
    <span class="text-muted small">· {{ $comment->created_at->diffForHumans() }}</span>
    <p>{{ $comment->body }}</p>

    <a class="btn btn-sm btn-link text-primary" data-bs-toggle="collapse" href="#reply{{ $comment->id }}">Balas</a>

    <div class="collapse mb-2" id="reply{{ $comment->id }}">
      <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="materi_id" value="{{ $materi->id }}">
        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
        <textarea name="body" class="form-control mb-1" rows="2" placeholder="Balas..." required></textarea>
        <button class="btn btn-sm btn-secondary">Kirim Balasan</button>
      </form>
    </div>

    @foreach($comment->replies as $reply)
      <div class="card ms-4 mt-2">
        <div class="card-body">
          <strong>{{ $reply->user->name }}</strong> <span class="text-muted small">· {{ $reply->created_at->diffForHumans() }}</span>
          <p>{{ $reply->body }}</p>
        </div>
      </div>
    @endforeach
  </div>
</div>
