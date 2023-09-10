<?php

namespace Database\Seeders;

use App\Models\Settlements;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;

class SettlementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settlements::truncate();

        $json = File::get(storage_path() . '/data/settlements.data');
        $settlements = json_decode($json, true);

        foreach ($settlements as $key => $settlement) {
            Settlements::factory()->create(
                [
                    'name' => $settlement['name'],
                    'postcode' => (int) $settlement['postcode'],
                    'description' => $settlement['description'],
                ]
            );
        }
    }
}
