@extends('guru.layouts.app')

@section('content')
<style>
    .materi-card {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .materi-card:hover {
        transform: scale(1.01);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08);
    }

    .page-title {
        font-weight: 800;
        font-size: 1.8rem;
        color: #2c3e50;
        text-shadow: 1px 1px 0 rgba(180, 180, 180, 0.3);
    }

    .btn-tambah {
        background: linear-gradient(135deg, #0d6efd, #6610f2);
        border: none;
        color: white;
        border-radius: 50px;
        font-weight: 600;
        padding: 10px 20px;
        transition: 0.3s ease;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .btn-tambah:hover {
        background: linear-gradient(135deg, #6610f2, #0d6efd);
        transform: translateY(-2px);
    }

    .table thead {
        background-color: #343a40;
        color: white;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: #f0f8ff;
        transition: 0.2s ease;
    }

    .btn-sm {
        border-radius: 30px;
        padding: 6px 14px;
    }

    .alert-success {
        border-radius: 12px;
        font-weight: 500;
    }

    .no-data {
        font-style: italic;
        color: #999;
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h3 class="page-title">📚 Daftar Materi Fotografi</h3>
        <a href="{{ route('guru.materi.create') }}" class="btn btn-tambah">➕ Tambah Materi</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="materi-card">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>File</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($materi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-start fw-semibold">{{ $item->judul }}</td>
                        <td class="text-start">{{ $item->deskripsi }}</td>
                        <td>
                            @php
                                use Illuminate\Support\Facades\Storage;
                                $fileExists = $item->file && Storage::disk('public')->exists($item->file);
                            @endphp
                            @if($fileExists)
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">📎 Lihat</a>
                            @else
                                <span class="no-data">Tidak ada / File hilang</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('guru.materi.edit', $item->id) }}" class="btn btn-sm btn-warning me-1">✏️</a>
                            <form action="{{ route('guru.materi.destroy', $item->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus materi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center no-data">📭 Belum ada materi yang tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
