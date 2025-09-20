<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Slot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = Service::all();

        Slot::factory()->count(100)->make()->each(function ($slot) use ($services) {
            $slot->service_id = $services->random()->id;
            $slot->save();
        });
    }
}
