<?php

namespace Database\Factories;

use App\Models\Partners;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PartnerTypes;

class PartnersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partners::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'partnertypes_id' => PartnerTypes::factory()->create(),
            'taxnumber' => $this->faker->word,
            'bankaccount' => $this->faker->word,
            'postcode' => $this->faker->randomDigitNotNull,
            'settlement_id' => $this->faker->randomDigitNotNull,
            'address' => $this->faker->word,
            'email' => $this->faker->word,
            'phonenumber' => $this->faker->word,
            'description' => $this->faker->word,
            'active' => 1,
        ];
    }
}
