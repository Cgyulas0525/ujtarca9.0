<?php

namespace Database\Factories;

use App\Models\ClosureCimlets;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClosureCimletsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClosureCimlets::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'closures_id' => $this->faker->randomDigitNotNull,
            'cimlets_id' => $this->faker->randomDigitNotNull,
            'value' => $this->faker->randomDigitNotNull,
        ];
    }
}
