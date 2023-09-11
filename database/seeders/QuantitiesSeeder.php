<?php

namespace Database\Seeders;

use App\Models\Quantities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class QuantitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Quantities::truncate();

        $json = Storage::disk('data')->get('quantities.data');
        $quantitties = json_decode($json, true);

        foreach ($quantitties as $key => $quantity) {
            Quantities::factory()->create(
                [
                    'name' => $quantity['name'],
                    'description' => $quantity['description'],
                ]
            );
        }
    }
}
