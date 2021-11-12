<?php

namespace Tests\Feature\MenuItem;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\MenuItem;

class MenuItemTest extends TestCase
{
     use RefreshDatabase;
     use WithoutMiddleware;

    /**
     * A basic feature test can fetch menuItems using GET.
     *
     * @return void
    */
    public function test_can_fetch_menuItems()
    {
        MenuItem::factory()->create() ;
        $response = $this->get('api/menu-item')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }


    /**
     * A basic feature test can create an menuItem .
     *
     * @return void
     */
    public function test_can_create_menuItem()
    {

        $data = @json_decode(json_encode(MenuItem::factory()->create()), true);
        $response = $this->json('POST', 'api/menu-item/', $data);
        $response ->assertStatus(201)
                ->assertJson([
                    'success' => true,
                ]);
    }

    /**
     * A basic feature test can fetch an menuItem using GET.
     *
     * @return void
    */
    public function test_can_fetch_menuItem()
    {
        $menuItem =  MenuItem::factory()->create();
        $response = $this->get('api/menu-item/'. $menuItem->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can update a menuItem using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_an_menuItem()
    {       
        MenuItem::factory()->create() ;
        $menuItem = MenuItem::first();

        $updateData = @json_decode(json_encode($menuItem), true);
        $response = $this->json('PUT', 'api/menu-item/'.$menuItem->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can soft delete an menuItem using DELETE.
     *
     * @return void
     */
    public function test_can_softdelete_an_menuItem()
    {       
        MenuItem::factory()->create();
        $menuItem = MenuItem::first();
        
        $response = $this->json('DELETE', 'api/menu-item/'.$menuItem->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can restore soft deleted menuItem .
     *
     * @return void
     */
    public function test_can_restore_menuItem()
    {       
       $menuItem =  MenuItem::factory()->create() ;
                
        $response = $this->json('DELETE', 'api/menu-item/'. $menuItem->id); 
        $response = $this->json('GET', 'api/menu-item/restore/'.$menuItem->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can parmanently delete an menuItem .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_menuItem()
    {       
       $menuItem =  MenuItem::factory()->create();
                
        $response = $this->json('DELETE', 'api/menu-item/'. $menuItem->id); 
        $response = $this->json('GET', 'api/menu-item/parmanently-delete/'.$menuItem->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

}
