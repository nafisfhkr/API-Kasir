<?php

namespace Database\Seeders;
use App\Models\Pengguna;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // Buat 1 user admin saja agar pasti bisa login
    $user = \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@mail.com',
        'password' => bcrypt('password123'),
    ]);

    // Hubungkan dengan tabel penggunas
    \App\Models\Pengguna::create([
        'user_id' => $user->id,
        'Nama' => 'Admin Kasir',
        'Email' => 'admin@mail.com',
        'Password' => $user->password,
        'No_hp' => '08123456789',
        'Role' => 'admin',
    ]);
}
}
