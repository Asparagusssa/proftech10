<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'title' => fake()->text(10),
            'image' => 'test/test.jpg',
            'related_title' => fake()->text(10),
            'order' => fake()->numberBetween(0,1) ? fake()->numberBetween(1, 10) : null,
        ];
    }
}
