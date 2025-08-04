@extends('guru.layouts.app')

@section('content')
<div class="container">
    <h1>Objek 3D Saya</h1>
    <a href="{{ route('guru.objek3d.create') }}" class="btn btn-primary mb-3">Tambah Objek 3D</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($objeks->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>File</th>
                    <th>Tanggal Upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($objeks as $objek)
                <tr>
                    <td>{{ $objek->judul }}</td>
                    <td>{{ $objek->deskripsi }}</td>
                    <td><a href="{{ asset('storage/' . $objek->file) }}" target="_blank">Lihat File</a></td>
                    <td>{{ $objek->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('guru.objek-3d.destroy', $objek) }}" method="POST" onsubmit="return confirm('Hapus objek ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $objeks->links() }}
    @else
        <p>Belum ada objek 3D yang diupload.</p>
    @endif
</div>
@endsection
