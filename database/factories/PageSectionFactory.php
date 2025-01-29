<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PageSectionFactory extends Factory
{
    protected $model = PageSection::class;

    public function definition(): array
    {
        return [
            'title' => fake()->text('20'),
            'content' => fake()->text('20'),
            'image' => 'test/test.jpg',
            'section_type_id' => fake()->numberBetween(1,5),
            'order' => fake()->numberBetween(0,1) ? fake()->numberBetween(1,10) : null,
        ];
    }

    public function forPage(Page $page): PageSectionFactory
    {
        return $this->state([
            'page_id' => $page->id,
        ]);

    }
}
