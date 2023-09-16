<?php

namespace Database\Seeders;

use App\Models\Settlements;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SettlementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Settlements::truncate();

        $json = Storage::disk('data')->get('settlements.data');
        $settlements = json_decode($json, true);

        foreach ($settlements as $key => $settlement) {
            Settlements::factory()->create(
                [
                    'name' => $settlement['name'],
                    'postcode' => $settlement['postcode'],
                    'description' => $settlement['description'],
                ]
            );
        }
    }
}
