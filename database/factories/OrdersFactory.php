<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Enums\OrderTypeEnum;
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
            'orderdate' => $this->faker->date,
            'partners_id' => Partners::factory()->create(),
            'description' => $this->faker->word,
            'order_status' => OrderStatusEnum::ORDERED->value,
            'delivered_date' => $this->faker->date,
            'ordertype' => OrderTypeEnum::CUSTOMER->value,
            'detailsum' => $this->faker->randomDigitNotNull,
        ];
    }
}
