@extends('layouts.guru')
@section('content')
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <h4>➕ Tambah Kamera 3D</h4>
<form method="POST" action="{{ route('guru.kamera3d.store') }}" enctype="multipart/form-data" onsubmit="return validateFile()">
    @csrf
    <input type="file" id="file" name="file" required>
    <button type="submit">Upload</button>
</form>

</div>
<script>
function validateFile() {
    const file = document.getElementById('file').files[0];
    if (!file) return true;
    
    const maxSize = 70 * 1024 * 1024; // 70 MB in bytes

    if (file.size > maxSize) {
        alert("Ukuran file terlalu besar. Maksimal 70MB.");
        return false;
    }

    return true;
}
</script>
@endsection
