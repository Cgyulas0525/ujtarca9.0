<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Products;

class ProdutsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_new_products_record(): void
    {
        $name = 'First product';
        $description = 'First product description';

        $qa = Products::factory()->create([
            'name' => $name,
            'description' => $description,
        ]);

        $this->assertEquals($qa->name, $name);
    }
}
