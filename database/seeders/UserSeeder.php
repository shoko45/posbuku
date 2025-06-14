<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'kasir',
            'email' => 'kasir@example.com',
            'role' => 'Kasir',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'Admin',
            'password' => Hash::make('password')
        ]);
    
    }
}