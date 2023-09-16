<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Quantities;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuantitiesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_new_quantities_record(): void
    {
        $name = 'Darab';
        $description = 'Darab description';

        $qa = Quantities::factory()->create([
            'name' => $name,
            'description' => $description,
        ]);

        $this->assertEquals($qa->name, $name);
        $this->assertModelExists($qa);
    }

}

