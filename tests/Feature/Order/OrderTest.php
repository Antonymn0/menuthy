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
     * A basic feature test can fetch an order using GET.
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

    /**
     * A basic feature test can update a order using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_an_order()
    {       
        Order::factory()->create() ;
        $order = Order::first();

        $updateData = @json_decode(json_encode($order), true);
        $response = $this->json('PUT', 'api/order/'.$order->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can soft delete an order using DELETE.
     *
     * @return void
     */
    public function test_can_delete_an_order()
    {       
        Order::factory()->create();
        $order = Order::first();
        
        $response = $this->json('DELETE', 'api/order/'.$order->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

      /**
     * A basic feature test can restore soft deleted order .
     *
     * @return void
     */
    public function test_can_restore_order()
    {       
       $order =  Order::factory()->create() ;
                
        $response = $this->json('DELETE', 'api/order/'. $order->id); 
        $response = $this->json('GET', 'api/order/restore/'.$order->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

     /**
     * A basic feature test can parmanently delete an order .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_order()
    {       
       $order =  Order::factory()->create();
                
        $response = $this->json('DELETE', 'api/order/'. $order->id); 
        $response = $this->json('GET', 'api/order/parmanently-delete/'.$order->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }


}
