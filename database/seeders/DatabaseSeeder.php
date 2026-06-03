<?php

namespace database\seeders;

use App\Models\User;
use App\Models\Barang;
use App\Models\Peminjam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User Akun Login
        User::create([
            'name' => 'Admin TeFA',
            'email' => 'admin@tefa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas TeFA',
            'email' => 'petugas@tefa.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
        ]);

        // Seeder Peminjam
        Peminjam::create(['nama_peminjam' => 'Ahmad Fauzan', 'kelas' => 'XI', 'jurusan' => 'PPLG 1', 'no_hp' => '081234567890']);
        Peminjam::create(['nama_peminjam' => 'Rizky Pratama', 'kelas' => 'XI', 'jurusan' => 'PPLG 2', 'no_hp' => '081234567891']);
        Peminjam::create(['nama_peminjam' => 'Dinda Putri', 'kelas' => 'XI', 'jurusan' => 'PPLG 1', 'no_hp' => '081234567892']);

        // Seeder Barang
        Barang::create(['nama_barang' => 'Laptop Asus', 'kategori_barang' => 'Laptop', 'stok' => 10, 'kondisi_barang' => 'Baik']);
        Barang::create(['nama_barang' => 'Mouse Logitech', 'kategori_barang' => 'Aksesoris', 'stok' => 15, 'kondisi_barang' => 'Baik']);
        Barang::create(['nama_barang' => 'Keyboard Mechanical', 'kategori_barang' => 'Aksesoris', 'stok' => 8, 'kondisi_barang' => 'Baik']);
    }
}
