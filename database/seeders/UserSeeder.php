<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user Guru dengan ID otomatis (biasanya 1 kalau kosong)
        $guru = User::firstOrCreate(
            ['email' => 'guru@example.com'],
            [
                'name' => 'Guru Contoh',
                'password' => bcrypt('password'),
            ]
        );
        $guru->assignRole('Guru');
    }
}
