<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'author_id' => Author::factory(),
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraph,
            'img_thumbnail' => $this->faker->imageUrl(640, 480, 'post-thumbnail'),
            'img_cover' => $this->faker->imageUrl(1280, 720, 'post-cover'),
            'content' => $this->faker->paragraphs(5, true),
            'is_trending' => $this->faker->boolean,
            'view_count' => $this->faker->numberBetween(100, 5000),
            'status' => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
