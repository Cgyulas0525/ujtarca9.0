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
    public function definition(): array
    {
        return [
            'closuredate' => $this->faker->date('Y-m-d H:i:s'),
            'card' => 0,
            'szcard' => 0,
            'dayduring' => 0,
            'dailysum' => 0,
        ];
    }
}
















