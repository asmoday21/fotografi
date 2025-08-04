<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereHas('roles', function ($q) {
            $q->whereIn('name', ['Guru', 'Siswa']);
        })->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::whereIn('name', ['Guru', 'Siswa'])->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis_nip'   => 'required|unique:users,nis_nip',
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
            'role'      => 'required'
        ]);

        $user = User::create([
            'nis_nip'  => $request->nis_nip, // ✅ DITAMBAHKAN
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['Guru', 'Siswa'])->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nis_nip'   => 'required|unique:users,nis_nip,' . $user->id, // ✅ Tambahkan validasi nis_nip juga saat update
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|in:Guru,Siswa',
            'password'  => 'nullable|confirmed'
        ]);

        try {
            $user->nis_nip = $request->nis_nip; // ✅ DITAMBAHKAN
            $user->name    = $request->name;
            $user->email   = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $user->syncRoles($request->role);

            return redirect()->route('admin.users.index')->with('success', 'User berhasil diubah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah user: ' . $e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Kamu tidak bisa menghapus akun kamu sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
