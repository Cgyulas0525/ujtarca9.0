<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Products;
use Illuminate\Foundation\Testing\RefreshDatabase;


class ProductsTest extends TestCase
{
    use RefreshDatabase;

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
        $this->assertModelExists($qa);

    }
}
