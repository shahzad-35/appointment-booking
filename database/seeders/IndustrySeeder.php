<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        Industry::insert([
            ['name' => 'Doctors'],
            ['name' => 'Salons'],
            ['name' => 'Consultants'],
        ]);
    }
}

