@extends('admin.layouts.admin')

@section('title', 'Kelola Soal Kuis')

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary"><i class="bi bi-patch-question-fill me-2"></i> Periksa Soal Kuis</h3>
        <!-- <a href="{{ route('admin.kuis.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Soal
        </a> -->
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary text-dark">
                    <tr>
                        <th style="width: 50%;">📄 Pertanyaan</th>
                        <th style="width: 20%;">✅ Jawaban Benar</th>
                        <th style="width: 30%;">⚙️ Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kuis as $k)
                    <tr>
                        <td class="text-start">{{ $k->pertanyaan }}</td>
                        <td>
                            <span class="badge bg-success text-uppercase px-3 py-2">{{ $k->jawaban_benar }}</span>
                        </td>
                        <td>
                            <!-- <a href="{{ route('admin.kuis.edit', $k->id) }}" class="btn btn-sm btn-outline-warning me-2">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a> -->
                            <form action="{{ route('admin.kuis.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus soal ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle me-2"></i> Belum ada soal kuis.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
