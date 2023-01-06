<?php

namespace Database\Factories;

use App\Models\Partners;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'partnertypes_id' => $this->faker->randomDigitNotNull,
        'taxnumber' => $this->faker->word,
        'bankaccount' => $this->faker->word,
        'postcode' => $this->faker->randomDigitNotNull,
        'settlement_id' => $this->faker->randomDigitNotNull,
        'address' => $this->faker->word,
        'email' => $this->faker->word,
        'phonenumber' => $this->faker->word,
        'description' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
