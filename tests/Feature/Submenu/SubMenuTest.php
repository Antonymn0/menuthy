<?php

namespace Tests\Feature\Submenu;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\SubMenu;

class SubMenuTest extends TestCase
{
    use RefreshDatabase;
     use WithoutMiddleware;

    /**
     * A basic feature test can fetch submenus using GET.
     *
     * @return void
    */
    public function test_can_fetch_submenus()
    {
        SubMenu::factory()->create() ;
        $response = $this->get('api/sub-menu')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can create an submenu .
     *
     * @return void
     */
    public function test_can_create_submenu()
    {
       
        $data = @json_decode(json_encode(SubMenu::factory()->create()), true);
        $response = $this->json('POST', 'api/sub-menu/', $data);
        $response ->assertStatus(201)
                ->assertJson([
                    'success' => true,
                ]);
    }

    /**
     * A basic feature test can fetch an subMenu using GET.
     *
     * @return void
    */
    public function test_can_fetch_subMenu()
    {
        $subMenu =  SubMenu::factory()->create();
        $response = $this->get('api/sub-menu/'. $subMenu->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can update a subMenu using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_subMenu()
    {       
        SubMenu::factory()->create() ;
        $subMenu = SubMenu::first();

        $updateData = @json_decode(json_encode($subMenu), true);
        $response = $this->json('PUT', 'api/sub-menu/'.$subMenu->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can soft delete an subMenu using DELETE.
     *
     * @return void
     */
    public function test_can_softdelete_an_subMenu()
    {       
        SubMenu::factory()->create();
        $subMenu = SubMenu::first();
        
        $response = $this->json('DELETE', 'api/sub-menu/'.$subMenu->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

      /**
     * A basic feature test can restore soft deleted subMenu .
     *
     * @return void
     */
    public function test_can_restore_subMenu()
    {       
       $subMenu =  SubMenu::factory()->create() ;
                
        $response = $this->json('DELETE', 'api/sub-menu/'. $subMenu->id); 
        $response = $this->json('GET', 'api/sub-menu/restore/'.$subMenu->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

     /**
     * A basic feature test can parmanently delete an subMenu .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_subMenu()
    {       
       $subMenu =  SubMenu::factory()->create();
                
        $response = $this->json('DELETE', 'api/sub-menu/'. $subMenu->id); 
        $response = $this->json('GET', 'api/sub-menu/parmanently-delete/'.$subMenu->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

}
