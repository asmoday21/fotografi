@extends('siswa.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10">
    <h2 class="text-4xl font-extrabold text-center text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-blue-600 mb-10">
        🎨 Galeri Karya Siswa
    </h2>

    @if($galeri->isEmpty())
        <div class="text-center text-gray-400 text-lg mt-10">
            📭 Belum ada karya yang diupload.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($galeri as $item)
                @php
                    $file = $item->file;
                    $isVideo = \Illuminate\Support\Str::endsWith($file, ['.mp4', '.mov', '.webm']);
                @endphp

                <div class="bg-white bg-opacity-5 border border-white/10 rounded-2xl shadow-xl backdrop-blur-md overflow-hidden hover:scale-[1.01] transition-all duration-300">
                    <div class="relative aspect-video bg-black">
                        @if($isVideo)
                            <video controls class="w-full h-full object-cover rounded-t-2xl">
                                <source src="{{ asset('storage/' . $file) }}" type="video/mp4">
                                Browser tidak mendukung video.
                            </video>
                        @else
                            <img src="{{ asset('storage/' . $file) }}"
                                 alt="{{ $item->judul }}"
                                 class="w-full h-full object-cover rounded-t-2xl">
                        @endif
                    </div>

                    <div class="p-4 text-white">
                        <h3 class="text-xl font-semibold truncate">{{ $item->judul }}</h3>
                        <p class="text-sm text-gray-300 mt-1 line-clamp-3">
                            {{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}
                        </p>
                        <div class="flex justify-between items-center mt-4 text-sm text-blue-300">
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
