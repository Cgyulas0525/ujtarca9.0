<?php

namespace Database\Factories;

use App\Models\Offerdetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferdetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offerdetails::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'offers_id' => $this->faker->randomDigitNotNull,
        'products_id' => $this->faker->randomDigitNotNull,
        'quantities_id' => $this->faker->randomDigitNotNull,
        'value' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
