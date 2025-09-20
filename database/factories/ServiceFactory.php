<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = \App\Models\Service::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),  // "Haircut Premium", "Yoga Class"
            'description' => $this->faker->sentence(6),
            'price' => $this->faker->randomFloat(2, 20, 300),
        ];
    }
}
