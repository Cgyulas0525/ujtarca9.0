<?php

namespace Database\Factories;

use App\Models\Invoices;
use App\Models\Partners;
use App\Models\PaymentMethods;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoices::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'partner_id' => Partners::factory()->create(),
            'invoicenumber' => $this->faker->word,
            'paymentmethod_id' => PaymentMethods::factory()->create(),
            'amount' => $this->faker->randomDigitNotNull,
            'dated' => $this->faker->date,
            'performancedate' => $this->faker->date,
            'deadline' => $this->faker->date,
            'description' => $this->faker->word,
        ];
    }
}
