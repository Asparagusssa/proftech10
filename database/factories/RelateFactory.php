<?php

namespace Database\Factories;

use App\Models\Relate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RelateFactory extends Factory
{
    protected $model = Relate::class;

    public function definition(): array
    {
        return [
            'title' => fake()->word,
        ];
    }
}
