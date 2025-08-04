@extends('guru.layouts.app')

@section('content')
<h2 class="mb-4 fw-bold">📝 Daftar Kuis Berdasarkan Judul</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="mb-4 text-end">
    <a href="{{ route('guru.kuis.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Kuis
    </a>
</div>

@php
    $grouped = $kuis->groupBy('judul');
@endphp

@if($grouped->count())
    <div class="row g-4">
        @foreach($grouped as $judul => $items)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top px-3 py-2"
                         style="cursor:pointer;" onclick="toggleSoal('{{ Str::slug($judul) }}')">
                        <div>
                            <i class="bi bi-journal-text me-2"></i><strong>{{ $judul }}</strong>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-light text-dark">{{ $items->count() }} Soal</span>
                           <form action="{{ route('guru.kuis.destroyJudul', ['judul' => $judul]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua soal dengan judul ini?')">

                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-light text-danger border-0 px-2 py-0" title="Hapus Semua Soal">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-body bg-light d-none" id="soal-{{ Str::slug($judul) }}" style="max-height: 400px; overflow-y: auto;">
                        @foreach($items as $index => $item)
                            <div class="bg-white p-3 mb-3 rounded shadow-sm border border-light">
                                <h6 class="fw-semibold">Soal {{ $index + 1 }}</h6>
                                <p class="mb-2">{{ $item->pertanyaan }}</p>
                                <ul class="list-unstyled mb-2">
                                    <li><strong>A:</strong> {{ $item->opsi_a }}</li>
                                    <li><strong>B:</strong> {{ $item->opsi_b }}</li>
                                    <li><strong>C:</strong> {{ $item->opsi_c }}</li>
                                    <li><strong>D:</strong> {{ $item->opsi_d }}</li>
                                </ul>
                                <p class="mb-2">
                                    <strong>Jawaban Benar:</strong> 
                                    <span class="badge bg-success">{{ $item->jawaban_benar }}</span>
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('guru.kuis.edit', $item->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('guru.kuis.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">Belum ada data kuis.</div>
@endif
@endsection

@push('scripts')
<script>
    function toggleSoal(id) {
        const el = document.getElementById('soal-' + id);
        el.classList.toggle('d-none');
    }
</script>
@endpush
