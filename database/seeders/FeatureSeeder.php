<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feature::truncate();

        $features = [
            'gluténmentes',
            'tejmentes',
            'tojásmentes',
            'cukormentes',
            'búzamentes',
            'élesztőmentes',
            'szójamentes',
            'vegán',
            'paleo',
        ];

        foreach ($features as $key => $feature) {
            Feature::factory()->create(
                [
                    'name' => $feature,
                    'description' => "",
                ]
            );
        }
    }
}
