@extends('siswa.layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">📘 Riwayat Kuis Saya</h4>

    @if ($jawaban->isEmpty())
        <div class="alert alert-info">Kamu belum pernah mengerjakan kuis.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban Saya</th>
                    <th>Jawaban Benar</th>
                    <th>Status</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jawaban as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kuis->pertanyaan }}</td>
                    <td>{{ $item->jawaban }}</td>
                    <td>{{ $item->kuis->jawaban_benar }}</td>
                    <td>
                        @if ($item->nilai)
                            <span class="badge bg-success">Benar</span>
                        @else
                            <span class="badge bg-danger">Salah</span>
                        @endif
                    </td>
                    <td>{{ $item->nilai }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
