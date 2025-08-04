@extends('admin.layouts.admin')
@section('title', 'Data Users')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0"><i class="bi bi-person-lines-fill text-warning me-2"></i>Daftar Guru & Siswa</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-warning shadow-sm animate__animated animate__fadeInRight">
            <i class="bi bi-plus-circle me-1"></i> Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive rounded shadow-sm animate__animated animate__zoomIn">
        <table class="table table-hover align-middle text-nowrap table-dark border rounded" id="userTable">
            <thead class="table-warning text-dark">
                <tr>
                    <th>👤 Nama</th>
                    <th>🆔 NIS/NIP</th>
                    <th>📧 Email</th>
                    <th>🛡️ Role</th>
                    <th class="text-center" style="width: 150px;">⚙️ Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="animate__animated animate__fadeInUp">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->nis_nip ?? '-' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge {{ $role->name == 'Guru' ? 'bg-info text-dark' : ($role->name == 'Siswa' ? 'bg-success' : 'bg-secondary') }}">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning me-2" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit" title="Hapus">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="bi bi-exclamation-circle me-2"></i>Belum ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Button animation
        const buttons = document.querySelectorAll("button, a.btn");
        buttons.forEach(btn => {
            btn.addEventListener("mouseenter", () => {
                btn.classList.add("animate__pulse");
            });
            btn.addEventListener("mouseleave", () => {
                btn.classList.remove("animate__pulse");
            });
        });

        // Theme toggle
        const themeBtn = document.getElementById('toggle-theme');
        if (themeBtn) {
            themeBtn.addEventListener('click', () => {
                document.body.classList.toggle('bg-light');
                document.body.classList.toggle('text-dark');
                document.querySelectorAll('.table').forEach(table => {
                    table.classList.toggle('table-dark');
                    table.classList.toggle('table-light');
                });
            });
        }
    });
</script>
@endsection
