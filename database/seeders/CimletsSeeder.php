<?php

namespace Database\Seeders;

use App\Models\Cimlets;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class CimletsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Cimlets::truncate();
        $json = Storage::disk('data')->get('cimlets.data');
        $cimlets = json_decode($json, true);

        foreach ($cimlets as $key => $cimlet) {
            Cimlets::factory()->create(
                [
                    'name' => $cimlet['name'],
                    'value' => $cimlet['value'],
                    'description' => $cimlet['description'],
                ]
            );
        }
    }
}
