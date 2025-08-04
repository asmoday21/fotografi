@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Kuis per Judul</h2>

        @foreach($kuis as $judul => $items)
            <div class="card mb-3">
                <div class="card-header">
                    <strong>{{ $judul }}</strong>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($items as $item)
                        <li class="list-group-item">
                            Soal: {{ $item->soal }} <br>
                            Jawaban: {{ $item->jawaban_benar }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
