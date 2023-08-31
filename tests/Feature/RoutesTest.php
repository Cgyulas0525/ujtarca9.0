<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_routes($route = null)
    {
        $route = is_null($route) ? '/' : '/' . $route;
        $response = $this->get($route);
        $response->assertStatus(200);
    }

    public function test_partners_route()
    {
        $routes = [
            'partners',
            'cimlets',
        ];

        foreach ($routes as $route) {
            $this->test_routes($route);
        }
    }

}
