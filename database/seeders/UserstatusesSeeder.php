<?php

namespace Database\Seeders;

use App\Models\Userstatuses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UserstatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Userstatuses::truncate();

        $json = Storage::disk('data')->get('userstatuses.data');
        $us = json_decode($json, true);

        foreach ($us as $key => $u) {
            Userstatuses::factory()->create(
                [
                    'name' => $u['name'],
                    'commit' => $u['commit'],
                ]
            );
        }
    }
}

