<?php

namespace Database\Factories;

use App\Models\BannerImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BannerImageFactory extends Factory
{
    protected $model = BannerImage::class;

    public function definition(): array
    {
        return [
            'banner_id' => 1,
            'image' => 'test/test.jpg',
            'order' => fake()->numberBetween(0,1) ? fake()->numberBetween(0, 10) : null,
        ];
    }
}
