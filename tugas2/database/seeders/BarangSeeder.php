<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barang')->insert([
            ['nama' => 'Buku Tulis',  'harga' => 5000,  'stok' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pulpen',      'harga' => 3000,  'stok' => 100,'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Penggaris',   'harga' => 4000,  'stok' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pensil 2B',   'harga' => 2500,  'stok' => 80, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Penghapus',   'harga' => 1500,  'stok' => 60, 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Spidol',      'harga' => 8000,  'stok' => 20, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}