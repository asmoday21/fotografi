@extends('guru.layouts.app')

@section('content')

<style>
    h1 {
        font-weight: 600;
        font-size: 28px;
    }

    .alert-info {
        background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
        border: none;
        border-left: 5px solid #00bcd4;
        font-size: 16px;
        padding: 15px 20px;
        border-radius: 12px;
        color: #004d40;
    }

    .card {
        border: none;
        border-radius: 16px;
    }

    .card-body {
        padding: 20px;
    }

    .table {
        font-size: 15px;
        border-radius: 8px;
        overflow: hidden;
    }

    thead.table-primary {
        background: linear-gradient(to right, #2196f3, #64b5f6);
        color: white;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f8ff;
    }

    .pagination {
        justify-content: center;
        margin-top: 20px;
    }

    @media screen and (max-width: 768px) {
        h1 {
            font-size: 22px;
        }

        .table-responsive {
            font-size: 14px;
        }

        .alert-info {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<h1 class="mb-4">📊 Hasil Kuis Siswa</h1>

{{-- Ringkasan Jumlah --}}
<div class="mb-3">
    <div class="alert alert-info d-flex justify-content-between flex-wrap gap-3">
        <div>🧑‍🎓 Total Siswa Menjawab Kuis: <strong>{{ $totalJawabanKuis }}</strong></div>
        <div>📂 Total Siswa Kumpulkan Tugas: <strong>{{ $totalTugasDikumpulkan }}</strong></div>
    </div>
</div>

{{-- Tabel Hasil Kuis --}}
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                         <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Judul Kuis</th> 
                        <th>Nilai</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hasil_kuis as $index => $hasil)
                        <tr>
                            <td>{{ $hasil_kuis->firstItem() + $index }}</td>
                            <td>{{ $hasil->user->nis_nip }}</td>
                            <td>{{ $hasil->user->name }}</td>
                            <td>{{ $hasil->kuis->judul }}</td>
                            <td><strong>{{ $hasil->nilai }}</strong></td>
                            <td>{{ $hasil->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada hasil kuis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Navigasi Halaman --}}
        <div class="d-flex justify-content-center">
            {{ $hasil_kuis->links() }}
        </div>
    </div>
</div>
@endsection