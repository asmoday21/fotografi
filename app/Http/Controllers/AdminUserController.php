<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::with('roles')->whereHas('roles', function($q) {
            $q->whereIn('name', ['Guru', 'Siswa']);
        })->get();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        $roles = Role::whereIn('name', ['Guru', 'Siswa'])->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:Guru,Siswa'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user) {
        $roles = Role::whereIn('name', ['Guru', 'Siswa'])->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:Guru,Siswa'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'User berhasil diubah');
    }

   public function destroy(User $user)
{
    // Cegah user menghapus dirinya sendiri (opsional tapi disarankan)
    if (Auth::id() === $user->id) {
        return redirect()->route('admin.users.index')->with('error', 'Kamu tidak bisa menghapus akun kamu sendiri.');
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
}
}
