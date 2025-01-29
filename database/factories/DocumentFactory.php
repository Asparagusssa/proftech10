<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition(): array
    {
        return [
            'title' => "Заголовок документа",
            'description' => "Описание документа",
            'image' => 'test/test.jpg',
            'file' => 'test/file.jpg',
            'filename' => "Название документа",
            'order' => fake()->numberBetween(1, 10),
        ];
    }
}
