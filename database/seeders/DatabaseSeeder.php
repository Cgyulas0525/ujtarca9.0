<?php

namespace Database\Seeders;

use App\Models\Quantities;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            SettlementsSeeder::class,
            CimletsSeeder::class,
            QuantitiesSeeder::class,
            UserstatusesSeeder::class,
        ]);
    }
}
