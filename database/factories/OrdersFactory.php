<?php

namespace Database\Factories;

use App\Models\Orders;
use App\Models\Partners;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    protected $model = Orders::class;

    public function definition(): array
    {
        return [
            'ordernumber' => $this->faker->word,
            'orderdate' => $this->faker->word,
            'partners_id' => Partners::factory()->create(),
            'description' => $this->faker->word,
        ];
    }
}
