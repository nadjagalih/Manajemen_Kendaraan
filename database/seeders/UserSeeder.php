<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kepala Cabang',
            'email' => 'cabang@mail.com',
            'password' => bcrypt('password'),
            'role' => 'kepala_cabang',
        ]);

        User::create([
            'name' => 'Kepala Pusat',
            'email' => 'pusat@mail.com',
            'password' => bcrypt('password'),
            'role' => 'kepala_pusat',
        ]);
    }
}
