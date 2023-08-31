<?php

namespace Database\Factories;

use App\Models\PartnerTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerTypesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartnerTypes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->word,
        ];
    }
}
