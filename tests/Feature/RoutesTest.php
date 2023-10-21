<?php

namespace Tests\Feature;

use Tests\TestCase;
use Auth;

class RoutesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_routes($route = null): void
    {
        $route = is_null($route) ? '/' : '/' . $route;
        $response = $this->get($route);
        $response->assertStatus(200);
    }

    public function test_indexes_route(): void
    {
        $routes = [
            'partners',
            'products',
            'orders',
            'cimlets',
            'paymentMethods',
            'quantities',
            'partnerTypes',
            'closures',
            'invoices',
            'RevenueExpenditureIndex',
            'RevenueExpenditureMonthIndex',
        ];

        foreach ($routes as $route) {
            $this->test_routes($route);
        }
    }
}
