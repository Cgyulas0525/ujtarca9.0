<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Userstatuses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Userstatuses>
 */
class UserstatusesFactory extends Factory
{
    protected $model = Userstatuses::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'commit' => $this->faker->word,
        ];
    }
}
