@extends('guru.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Kelola Soal Kuis 📝</h2>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('kuis.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Soal
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Pertanyaan</th>
                        <th>Opsi A</th>
                        <th>Opsi B</th>
                        <th>Opsi C</th>
                        <th>Opsi D</th>
                        <th>Jawaban Benar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($kuis as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pertanyaan }}</td>
                        <td>{{ $item->opsi_a }}</td>
                        <td>{{ $item->opsi_b }}</td>
                        <td>{{ $item->opsi_c }}</td>
                        <td>{{ $item->opsi_d }}</td>
                        <td>{{ strtoupper($item->jawaban_benar) }}</td>
                        <td>
                            <a href="{{ route('kuis.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('kuis.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Belum ada soal kuis.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
