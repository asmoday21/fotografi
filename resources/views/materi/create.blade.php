<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Materi - Media Fotografi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; padding-top: 60px; }
        .btn-custom { background-color: #007bff; color: white; }
        .btn-custom:hover { background-color: #0056b3; color: white; }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">Tambah Materi Baru</h1>

    <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        @include('materi.form')

        <button type="submit" class="btn btn-custom">Simpan Materi</button>
        <a href="{{ route('materi.index') }}" class="btn btn-secondary ms-2">Batal</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
