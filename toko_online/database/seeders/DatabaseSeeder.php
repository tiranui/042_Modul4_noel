<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'id_user'      => '0001',
            'nama_lengkap' => 'Immanoel',
            'email'        => 'Noel@gmail.com',
            'username'     => 'noel',
            'password'     => 'noel123',
            'no_hp'        => '081234567890',
            'alamat'       => 'Jl. Cikutra No. 1, Bandung',
        ]);

        User::create([
            'id_user'      => '0002',
            'nama_lengkap' => 'Daniel Angelica',
            'email'        => 'daniel@gmail.com',
            'username'     => 'daniel',
            'password'     => 'daniel123',
            'no_hp'        => '089876543210',
            'alamat'       => 'Jl. Sudirman No. 5, Bandung',
        ]);


        $produk = [
            ['Buku Tulis',   5000,  50],
            ['Pulpen',       3000, 100],
            ['Penggaris',    4000,  30],
            ['Pensil 2B',    2500,  80],
            ['Penghapus',    1500,  60],
            ['Spidol',       8000,  0],
            ['Buku Gambar', 10000,  25],
            ['Lem Kertas',   6000,  40],
            ['Gunting',     12000,  15],
            ['Stabilo',     15000,  18],
        ];

        foreach ($produk as $i => $p) {
            Product::create([
                'id_barang'   => 'BRG' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'nama_barang' => $p[0],
                'harga'       => $p[1],
                'stok'        => $p[2],
                'gambar'      => 'https://placehold.co/120x120/1a57a0/ffffff?text=' . urlencode($p[0]),
                'deskripsi'   => 'Alat tulis berkualitas, ' . $p[0],
            ]);
        }
    }
}