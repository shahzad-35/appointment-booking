<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class SlotFactory extends Factory
{
    protected $model = \App\Models\Slot::class;

    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('+0 days', '+30 days');
        $startHour = rand(8, 16);
        $endHour = $startHour + 1;

        return [
            'date' => $date->format('Y-m-d'),
            'start_time' => sprintf('%02d:00:00', $startHour),
            'end_time' => sprintf('%02d:00:00', $endHour),
            'is_booked' => false,
        ];
    }
}
