<?php

namespace Tests\Feature;

use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Partners;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_partner_deactivation(): void
    {
        $this->get( "api/partnerDeactivation")
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_getProduct(): void
    {
        $id = 1;
        $this->get("api/getProduct", ['id' => $id])
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_getQuantity(): void
    {
        $id = 1;
        $this->get("api/getQuantity", ['id' => $id])
            ->assertStatus(Response::HTTP_OK);
    }

    public function test_partnerActiveFlag(): void
    {
        $id = Partners::factory()->create();
        $this->get("api/partnerActiveFlag", ['id' => $id])
            ->assertStatus(302);
    }
}
