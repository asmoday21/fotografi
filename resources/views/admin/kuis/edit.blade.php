@extends('admin.layouts.admin')
@section('content')
<div class="container mt-4">
    <h4>{{ isset($kui) ? 'Edit Soal Kuis' : 'Tambah Soal Kuis' }}</h4>

    <form method="POST" action="{{ isset($kui) ? route('admin.kuis.update', $kui->id) : route('admin.kuis.store') }}">
        @csrf
        @if(isset($kui))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Pertanyaan</label>
            <textarea name="pertanyaan" class="form-control" required>{{ $kui->pertanyaan ?? '' }}</textarea>
        </div>

        @foreach(['a','b','c','d'] as $opt)
            <div class="mb-3">
                <label>Opsi {{ strtoupper($opt) }}</label>
                <input type="text" name="opsi_{{ $opt }}" class="form-control" value="{{ $kui->{'opsi_'.$opt} ?? '' }}" required>
            </div>
        @endforeach

        <div class="mb-3">
            <label>Jawaban Benar</label>
            <select name="jawaban_benar" class="form-control" required>
                @foreach(['a','b','c','d'] as $opt)
                    <option value="{{ $opt }}" {{ (isset($kui) && $kui->jawaban_benar == $opt) ? 'selected' : '' }}>
                        {{ strtoupper($opt) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">{{ isset($kui) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection
