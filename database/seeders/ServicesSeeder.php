<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = User::where('role', 'business_owner')->get();
        $industries = Industry::all();

        Service::factory()->count(50)->make()->each(function ($service) use ($owners, $industries) {
            $service->owner_id = $owners->random()->id;
            $service->industry_id = $industries->random()->id;
            $service->save();
        });
    }
}
