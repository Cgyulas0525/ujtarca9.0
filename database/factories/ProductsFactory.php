<?php

namespace Database\Factories;

use App\Enums\ActiveEnum;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Quantities;

class ProductsFactory extends Factory
{
    protected $model = Products::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'quantities_id' => Quantities::factory()->create(),
            'price' => $this->faker->randomDigitNotNull,
            'supplierprice' => $this->faker->randomDigitNotNull,
            'description' => $this->faker->word,
            'active' => ActiveEnum::ACTIVE->value,
        ];
    }
}
