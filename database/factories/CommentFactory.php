<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $posts = Post::all()->count();
        $users = User::all()->count();

        return [
            'post_id' => $this->faker->numberBetween(1, $posts),
            'user_id' => $this->faker->numberBetween(1, $users),
            'body' => $this->faker->paragraph()
        ];
    }
}
