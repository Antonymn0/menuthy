<?php

namespace Tests\Feature\Restaurant;

use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test can fetch restaurants using GET.
     *
     * @return void
    */
    public function test_can_fetch_restaurants()
    {
        $user = Passport::actingAs( User::factory()->create());
        Restaurant::factory()->create() ;
        $response = $this->get('api/order')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can create a restaurant .
     *
     * @return void
     */
    public function test_can_create_restaurant()
    {
        $user = Passport::actingAs( User::factory()->create());
        $restaurant = Restaurant::factory()->create();
        $data = @json_decode(json_encode(Restaurant::factory()->create()), true);
        $response = $this->json('POST', 'api/restaurant/', $data);
        $response ->assertStatus(201)
                ->assertJson([
                    'success' => true,
                ]);
    }

    /**
     * A basic feature test can fetch a restaurant using GET.
     *
     * @return void
    */
    public function test_can_fetch_restaurant()
    {
        $user = Passport::actingAs( User::factory()->create());
        $restaurant =  Restaurant::factory()->create();
        $response = $this->get('api/restaurant/'. $restaurant->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can update a restaurant using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_an_restaurant()
    {       
        $user = Passport::actingAs( User::factory()->create());
        Restaurant::factory()->create() ;
        $restaurant = restaurant::first();

        $updateData = @json_decode(json_encode($restaurant), true);
        $response = $this->json('PUT', 'api/restaurant/'.$restaurant->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can soft delete a restaurant using DELETE.
     *
     * @return void
     */
    public function test_can_softdelete_an_restaurant()
    {       
        $user = Passport::actingAs( User::factory()->create());
        Restaurant::factory()->create();
        $restaurant = Restaurant::first();
        
        $response = $this->json('DELETE', 'api/restaurant/'.$restaurant->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can restore soft deleted restaurantr .
     *
     * @return void
     */
    public function test_can_restore_restaurantr()
    {       
        $user = Passport::actingAs( User::factory()->create());
       $restaurant =  Restaurant::factory()->create() ;
                
        $response = $this->json('DELETE', 'api/restaurant/'. $restaurant->id); 
        $response = $this->json('GET', 'api/restaurant/restore/'.$restaurant->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can parmanently delete an restaurant .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_restaurant()
    {       
        $user = Passport::actingAs( User::factory()->create());
       $restaurant =  Restaurant::factory()->create();
                
        $response = $this->json('DELETE', 'api/restaurant/'. $restaurant->id); 
        $response = $this->json('GET', 'api/restaurant/parmanently-delete/'.$restaurant->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

}
