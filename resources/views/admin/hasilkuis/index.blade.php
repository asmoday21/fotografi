@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Hasil Kuis Siswa</h1>

    <form method="GET" action="{{ route('admin.hasilkuis.index') }}" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari Nama Siswa..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="kuis_id" class="form-control">
                <option value="">-- Semua Kuis --</option>
                @foreach($kuisList as $kuis)
                    <option value="{{ $kuis->id }}" {{ request('kuis_id') == $kuis->id ? 'selected' : '' }}>
                        {{ $kuis->judul }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.hasilkuis.export', request()->query()) }}" class="btn btn-success">Export Excel</a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kuis</th>
                <th>Nilai</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($hasilKuis as $index => $hasil)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $hasil->user->name ?? '-' }}</td>
                <td>{{ $hasil->kuis->judul ?? '-' }}</td>
                <td>{{ $hasil->nilai }}</td>
                <td>{{ $hasil->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Data tidak ditemukan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
