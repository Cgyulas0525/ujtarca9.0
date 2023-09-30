<?php

namespace Database\Factories;

use App\Models\Orderdetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Quantities;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderdetailsFactory extends Factory
{
    protected $model = Orderdetails::class;

    public function definition(): array
    {
        return [
            'orders_id' => 1,
            'products_id' => Products::factory()->create(),
            'quantities_id' => 1,
            'value' => $this->faker->randomDigitNotNull,
        ];
    }
}
