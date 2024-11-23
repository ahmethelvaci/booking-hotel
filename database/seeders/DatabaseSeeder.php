<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test',
            'surname' => 'User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            RegionSeeder::class,
            FeatureItemSeeder::class,
            HotelSeeder::class,
        ]);
    }
}
