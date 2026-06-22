<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Users trước (Posts cần user_id)
        $this->call(UserSeeder::class);
        // 2. Categories (Posts cần category_id)
        $this->call(CategorySeeder::class);
        // 3. Tags (Posts cần tags để sync pivot)
        $this->call(TagSeeder::class);
        // 4. Posts (cần users + categories + tags đã có)
        $this->call(PostSeeder::class);
        // 5. Comments (cần users + posts đã có)
        $this->call(CommentSeeder::class);
    }
}
