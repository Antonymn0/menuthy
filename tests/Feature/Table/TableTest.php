<?php

namespace Tests\Feature\Table;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Table;

class TableTest extends TestCase
{
     use RefreshDatabase;
     use WithoutMiddleware;

    /**
     * A basic feature test can fetch tables using GET.
     *
     * @return void
    */
    public function test_can_fetch_tables()
    {
        Table::factory()->create() ;
        $response = $this->get('api/table')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }


    /**
     * A basic feature test can create an table .
     *
     * @return void
     */
    public function test_can_create_table()
    {
        
        $data = @json_decode(json_encode(Table::factory()->create()), true);
        $response = $this->json('POST', 'api/table/', $data);
        $response ->assertStatus(201)
                ->assertJson([
                    'success' => true,
                ]);
    }

     /**
     * A basic feature test can fetch a table using GET.
     *
     * @return void
    */
    public function test_can_fetch_table()
    {
        $table =  Table::factory()->create();
        $response = $this->get('api/table/'. $table->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }


    /**
     * A basic feature test can update a table using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_an_table()
    {       
        Table::factory()->create() ;
        $table = table::first();

        $updateData = @json_decode(json_encode($table), true);
        $response = $this->json('PUT', 'api/table/'.$table->id, $updateData); 
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    ]);                  
    }

    /**
     * A basic feature test can soft delete an table using DELETE.
     *
     * @return void
     */
    public function test_can_softdelete_an_table()
    {       
        Table::factory()->create();
        $table = Table::first();
        
        $response = $this->json('DELETE', 'api/table/'.$table->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can restore soft deleted table .
     *
     * @return void
     */
    public function test_can_restore_table()
    {       
       $table =  Table::factory()->create() ;
                
        $response = $this->json('DELETE', 'api/table/'. $table->id); 
        $response = $this->json('GET', 'api/table/restore/'.$table->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can parmanently delete an table .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_table()
    {       
       $table =  Table::factory()->create();
                
        $response = $this->json('DELETE', 'api/table/'. $table->id); 
        $response = $this->json('GET', 'api/table/parmanently-delete/'.$table->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

}
