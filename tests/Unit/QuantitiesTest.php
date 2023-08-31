<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Quantities;

class QuantitiesTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_new_quantities_record()
    {
        $name = 'Darab';
        $description = 'Darab description';

        $qa = Quantities::factory()->create([
            'name' => $name,
            'description' => $description,
        ]);

        $this->assertEquals($qa->name, $name);
    }

}