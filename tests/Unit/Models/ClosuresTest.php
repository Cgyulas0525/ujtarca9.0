<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Closures;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClosuresTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_new_closures_record(): void
    {
        $date = now()->toDateString();

        $qa = Closures::factory()->create([
            'closuredate' => $date,
        ]);

        $this->assertModelExists($qa);
    }
}
