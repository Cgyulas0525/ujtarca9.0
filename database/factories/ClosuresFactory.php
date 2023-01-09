<?php

namespace Database\Factories;

use App\Models\Closures;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClosuresFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Closures::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'closuredate' => $this->faker->word,
            'card' => $this->faker->randomDigitNotNull,
            'szcard' => $this->faker->randomDigitNotNull,
            'dayduring' => $this->faker->randomDigitNotNull,
            'dailysum' => $this->faker->randomDigitNotNull,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s'),
            'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
