<?php

declare(strict_types=1);

namespace Database\Factories;

use Domain\Blogging\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
final class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->words(5, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->randomHtml,
            'description' => $this->faker->sentences(2, true),
            'published' => $this->faker->boolean
        ];
    }
}
