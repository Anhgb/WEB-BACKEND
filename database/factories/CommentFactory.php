<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'post_id'     => Post::inRandomOrder()->first()?->id ?? 1,
            'user_id'     => User::inRandomOrder()->first()?->id ?? 1,
            'body'        => $this->faker->paragraph(2),
            'is_approved' => $this->faker->boolean(70), // 70% cơ hội được duyệt
        ];
    }
}
