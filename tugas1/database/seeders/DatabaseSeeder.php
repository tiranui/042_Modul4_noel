<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'     => 'Noel',
            'password'     => 'noel123',    
            'nama_lengkap' => 'Immanoel',
        ]);

        User::create([
            'username'     => 'Daniel',
            'password'     => 'daniel123',
            'nama_lengkap' => 'Daniel',
        ]);
    }
}