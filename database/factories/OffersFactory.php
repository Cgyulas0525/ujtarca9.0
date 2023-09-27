<?php

namespace Database\Factories;

use App\Models\Offers;
use App\Models\Partners;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffersFactory extends Factory
{
    protected $model = Offers::class;

    public function definition(): array
    {
        return [
            'offernumber' => $this->faker->word,
            'offerdate' => $this->faker->word,
            'partners_id' => Partners::factory()->create(),
            'description' => $this->faker->word,
        ];
    }
}
