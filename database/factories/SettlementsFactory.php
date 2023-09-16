<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Settlements;

class SettlementsFactory extends Factory
{
    protected $model = Settlements::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'postcode' => $this->faker->randomDigitNotNull,
            'description' => $this->faker->word,
        ];
    }
}
