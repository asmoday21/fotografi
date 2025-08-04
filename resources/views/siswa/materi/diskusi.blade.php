@extends('siswa.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
  <h2 class="text-2xl font-bold text-blue-500 dark:text-blue-300 mb-6">
    🗨️ Diskusi Materi: <span class="text-gray-800 dark:text-white">{{ $materi->judul }}</span>
  </h2>

  @foreach (['success', 'error'] as $msg)
    @if(session($msg))
      <div class="mb-4 px-4 py-3 rounded bg-{{ $msg == 'success' ? 'green' : 'red' }}-100 text-{{ $msg == 'success' ? 'green' : 'red' }}-800 dark:bg-opacity-20">
        {{ session($msg) }}
      </div>
    @endif
  @endforeach

  @if ($errors->any())
    <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 dark:bg-opacity-20">
      {{ $errors->first() }}
    </div>
  @endif

  <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow mb-6">
    <h4 class="font-semibold text-gray-700 dark:text-gray-200 mb-2">📄 Deskripsi Materi:</h4>
    <p class="text-gray-600 dark:text-gray-300">{{ $materi->deskripsi }}</p>
  </div>

  <div class="bg-white dark:bg-gray-800 p-5 rounded-lg shadow mb-6">
    <h4 class="font-semibold text-blue-500 mb-3">✍️ Tulis Komentar</h4>
    <form action="{{ route('komentar.store') }}" method="POST">
      @csrf
      <input type="hidden" name="materi_id" value="{{ $materi->id }}">
      <textarea name="content" class="w-full p-3 rounded border dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white mb-3" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
      <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        <i class="bi bi-send-fill me-1"></i> Kirim
      </button>
    </form>
  </div>

  <h4 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">💬 Komentar:</h4>

  @forelse ($materi->komentars->whereNull('parent_id') as $komentar)
    <div class="mb-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
      <div class="flex items-end justify-start gap-3">
        <div class="flex-shrink-0">
          <div class="w-10 h-10 bg-blue-200 dark:bg-blue-500 text-white rounded-full flex items-center justify-center">
            {{ substr($komentar->user->name ?? 'U', 0, 1) }}
          </div>
        </div>
        <div class="flex-1">
          <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-xl">
            <div class="flex justify-between items-center mb-1">
              <span class="font-semibold text-gray-800 dark:text-white">{{ $komentar->user->name ?? 'Pengguna' }}</span>
              <span class="text-sm text-gray-400">{{ $komentar->created_at->diffForHumans() }}</span>
            </div>
            <p class="text-gray-700 dark:text-gray-300">{{ $komentar->content }}</p>
          </div>

          @foreach ($komentar->replies as $balasan)
            <div class="mt-3 ml-4 flex items-start gap-3">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-purple-300 dark:bg-purple-600 text-white rounded-full flex items-center justify-center text-sm">
                  {{ substr($balasan->user->name ?? 'U', 0, 1) }}
                </div>
              </div>
              <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-xl w-full">
                <div class="flex justify-between items-center mb-1">
                  <span class="font-semibold text-gray-700 dark:text-white">{{ $balasan->user->name ?? 'Pengguna' }}</span>
                  <span class="text-sm text-gray-400">{{ $balasan->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300">{{ $balasan->content }}</p>
              </div>
            </div>
          @endforeach

          <form action="{{ route('komentar.store') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="materi_id" value="{{ $materi->id }}">
            <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
            <textarea name="content" class="w-full p-2 rounded border dark:border-gray-700 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white mb-2" rows="2" placeholder="Tulis balasan..." required></textarea>
            <button class="text-sm bg-blue-100 dark:bg-blue-700 text-blue-800 dark:text-white px-3 py-1 rounded hover:bg-blue-200 dark:hover:bg-blue-600 transition">
              <i class="bi bi-reply-fill me-1"></i> Balas
            </button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <p class="text-gray-500">Belum ada komentar untuk materi ini. Jadilah yang pertama!</p>
  @endforelse
</div>
@endsection
