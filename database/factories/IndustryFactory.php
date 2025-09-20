<?php

namespace Database\Factories;

use App\Models\Industry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Industry>
 */
class IndustryFactory extends Factory
{
    protected $model = Industry::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = ['Salon', 'Fitness', 'Spa', 'Consulting', 'IT Services', 'Healthcare'];
        return [
            'name' => $this->faker->unique()->randomElement($industries),
        ];
    }
}
