<?php

namespace Database\Factories;

use App\Models\SectionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SectionTypeFactory extends Factory
{
    protected $model = SectionType::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
        ];
    }
}
