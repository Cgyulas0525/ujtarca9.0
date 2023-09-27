<?php

namespace Database\Factories;

use App\Models\Offerdetails;
use App\Models\Offers;
use App\Models\Products;
use App\Models\Quantities;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferdetailsFactory extends Factory
{
    protected $model = Offerdetails::class;

    public function definition()
    {
        return [
            'offers_id' => Offers::factory()->create(),
            'products_id' => Products::factory()->create(),
            'quantities_id' => Quantities::factory()->create(),
            'value' => $this->faker->randomDigitNotNull,
        ];
    }
}
