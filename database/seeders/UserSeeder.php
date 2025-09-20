<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
//
//        User::create([
//            'name' => 'Business Owner',
//            'email' => 'owner@example.com',
//            'password' => Hash::make('password'),
//            'role' => 'business_owner',
//        ]);
//
//        User::create([
//            'name' => 'Customer User',
//            'email' => 'customer@example.com',
//            'password' => Hash::make('password'),
//            'role' => 'customer',
//        ]);
        User::factory()->count(10)->create(['role' => 'business_owner']);

        User::factory()->count(20)->create(['role' => 'customer']);

    }
}
