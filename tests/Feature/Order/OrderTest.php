<?php

namespace Tests\Feature\Order;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
{
     use RefreshDatabase;
     use WithoutMiddleware;

    /**
     * A basic feature test can fetch oders using GET.
     *
     * @return void
    */
    public function test_can_fetch_oders()
    {
        Order::factory()->create() ;
        $response = $this->get('api/order')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

      /**
     * A basic feature test can create an order .
     *
     * @return void
     */
    public function test_can_create_order()
    {
        $order = Order::factory()->create();
        $data = @json_decode(json_encode(Order::factory()->create()), true);
        $response = $this->json('POST', 'api/order/', $data);
        $response ->assertStatus(201)
                ->assertJson([
                    'success' => true,
                ]);
    }

    /**
     * A basic feature test can fetch order using GET.
     *
     * @return void
    */
    public function test_can_fetch_order()
    {
        $order =  Order::factory()->create();
        $response = $this->get('api/order/'. $order->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

}
