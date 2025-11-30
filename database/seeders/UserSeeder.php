<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'vinhartz06',
            'email' => 'vinhartz06@example.com',
            'password' => Hash::make('vincent123'),
            'role' => 'user',
            'club' => null,
        ]);

        User::create([
            'name' => 'fikom_admin',
            'email' => 'fikom_admin@example.com',
            'password' => Hash::make('fikom123'),
            'role' => 'club',
            'club' => 'FIKOM',
        ]);

        User::create([
            'name' => 'fpsi_admin',
            'email' => 'fpsi_admin@example.com',
            'password' => Hash::make('fpsi1234'),
            'role' => 'club',
            'club' => 'FPSI',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'club' => null,
        ]);
    }
}

// php artisan db:seed --class=UserSeeder