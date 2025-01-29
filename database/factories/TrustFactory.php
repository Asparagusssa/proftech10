<?php

namespace Database\Factories;

use App\Models\Trust;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TrustFactory extends Factory
{
    protected $model = Trust::class;

    public function definition(): array
    {
        return [
            'image' => 'test/test.jpg',
            'order' => fake()->numberBetween(0,1) ? fake()->numberBetween(1, 10) : null,
        ];
    }
}
