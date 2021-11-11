<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * A basic feature test can fetch users using GET.
     *
     * @return void
    */
    public function test_can_fetch_users()
    {
        Passport::actingAs( User::factory()->create() );
        $response = $this->get('api/user')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

     /**
     * A basic feature test can create a user .
     *
     * @return void
     */
    public function test_can_create_user()
    {
        
        $data = @json_decode(json_encode( User::factory()->create()), true);
        $user = User::first()->delete();
        $response = $this->json('POST', 'api/user/', $data);
        $response = $this->json('GET', 'api/user');
        $response ->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ]);
    }

    /**
     * A basic feature test can update a user using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_a_user()
    {       
        Passport::actingAs( User::factory()->create() );
        $user = User::first();

        $updateData = @json_decode(json_encode($user), true);
        $response = $this->json('PUT', 'api/user/'.$user->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can delete a user using DELETE.
     *
     * @return void
     */
    public function test_can_delete_user()
    {       
        Passport::actingAs( User::factory()->create() );
        $user = User::first();
        
        $response = $this->json('DELETE', 'api/user/'.$user->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can restore soft deleted user .
     *
     * @return void
     */
    public function test_can_restore_user()
    {       
       $user = Passport::actingAs( User::factory()->create() );
                
        $response = $this->json('DELETE', 'api/user/'. $user->id); 
        $response = $this->json('GET', 'api/user/restore/'.$user->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can parmanently delete a user .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_user()
    {       
       $user = Passport::actingAs( User::factory()->create() );
                
        $response = $this->json('DELETE', 'api/user/'. $user->id); 
        $response = $this->json('GET', 'api/user/parmanently-delete/'.$user->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

}
