<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    { 
        User::create([
            'name' => 'samir',
            'email' => 'samir@gmail.com',
            'password' => Hash::make('samir123'),  
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'samir1',
            'email' => 'samir1@gmail.com',
            'password' => Hash::make('samir123'),  
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'samir2',
            'email' => 'samir2@gmail.com',
            'password' => Hash::make('samir123'),  
            'role' => 'admin',
        ]);
    }
}
