<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Prophecy\Call\Call;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all()->count();
        $categories = Category::all()->count();

        return [
            'user_id' => $this->faker->numberBetween(1, $users),
            'category_id' => $this->faker->numberBetween(1, $categories),
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'excerpt' => '<p>' . implode('</p><p>', $this->faker->paragraphs(2)) . '</p>',
            'body' => '<p>' . implode('</p><p>', $this->faker->paragraphs(6)) . '</p>',
            'published_at' => $this->faker->date()
        ];
    }
}
