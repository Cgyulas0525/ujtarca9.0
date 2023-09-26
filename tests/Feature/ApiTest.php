<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Partners;
use App\Models\Invoices;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_partner_inactivation(): void
    {
        $partners = Partners::factory()->count(3)->create();
        $invoice = Invoices::factory()->create(
            [
                'partner_id' => $partners->first()->id,
            ]
        );
        $partner = Partners::factory()->create();

        $this->get( "api/partnerInactivation")
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
