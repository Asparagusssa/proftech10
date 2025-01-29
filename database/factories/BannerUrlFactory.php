<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\BannerUrl;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BannerUrlFactory extends Factory
{
    protected $model = BannerUrl::class;

    public function definition(): array
    {
        return [
            'banner_id' => 1,
            'title' => fake()->word(),
            'url' => fake()->url,
            'image' => 'test/test.jpg',
            'order' => fake()->numberBetween(0,1) ? fake()->numberBetween(0,10) : null,
        ];
    }
}
