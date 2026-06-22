<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo admin account cố định
        User::create([
            'name'              => 'Admin Blog',
            'email'             => 'admin@phu-xuan-blog.test',
            'password'          => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        // Tạo 9 user ngẫu nhiên
        User::factory()->count(9)->create();
    }
}
