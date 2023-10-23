<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Component::truncate();

        $components = [
            'átlagos tápérték',
            'energia',
            'zsír',
            'telített zsír',
            'szénhidrát',
            'cukor',
            'rost',
            'fehérje',
            'só',
        ];

        foreach ($components as $key => $component) {
            Component::factory()->create(
                [
                    'name' => $component,
                    'description' => "",
                ]
            );
        }
    }
}
