<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // pastikan enkripsi password
            'role' => 'Manager',
            'profile_image' => null,
            'display_username' => 'Admin',
            'is_first_login' => 1,
        ]);
    }
}
