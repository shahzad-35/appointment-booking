<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = User::where('role', 'customer')->get();
        $slots = Slot::all();

        Booking::factory()->count(50)->make()->each(function ($booking) use ($customers, $slots) {
            $booking->user_id = $customers->random()->id;
            $booking->slot_id = $slots->random()->id;
            $booking->status = collect(['pending', 'confirmed', 'cancelled'])->random();
            $booking->save();
        });
    }
}
