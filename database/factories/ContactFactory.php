<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'phone' => '8 (341) 454 05 10',
            'email' => 'promtechno18@yandex.ru',
            'address' => 'г. Воткинск, ул. Тихая, д. 12, каб. 1'
        ];
    }
}
