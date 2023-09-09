<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Cimlets;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CimletsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_new_cimlets_record(): void
    {
        $name = 'First cimlets';
        $description = 'First cimlets description';

        $qa = Cimlets::factory()->create([
            'name' => $name,
            'description' => $description,
        ]);

        $this->assertEquals($qa->name, $name);
        $this->assertModelExists($qa);

    }
}
