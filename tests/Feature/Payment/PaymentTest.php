<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\Payment;

class PaymentTest extends TestCase
{
    use RefreshDatabase;
     use WithoutMiddleware;

    /**
     * A basic feature test can fetch payments using GET.
     *
     * @return void
    */
    public function test_can_fetch_payments()
    {
        Payment::factory()->create() ;
        $response = $this->get('api/payment')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can create an payment .
     *
     * @return void
     */
    public function test_can_create_payment()
    {
       
        $data = @json_decode(json_encode(Payment::factory()->create()), true);
        $data['transaction_id']= 'BHJU534Rkk526263';
        $response = $this->json('POST', 'api/payment/', $data);
        $response ->assertStatus(201)
                ->assertJson([
                    'success' => true,
                ]);
    }

    /**
     * A basic feature test can fetch an payment using GET.
     *
     * @return void
    */
    public function test_can_fetch_payment()
    {
        $payment =  Payment::factory()->create();
        $response = $this->get('api/payment/'. $payment->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can update a payment using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_an_payment()
    {            
        $payment = Payment::factory()->create() ;
        $updateData = @json_decode(json_encode($payment), true);
        $response = $this->json('PUT', 'api/payment/'.$payment->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can soft delete an payment using DELETE.
     *
     * @return void
     */
    public function test_can_softdelete_an_payment()
    {       
        $payment =  Payment::factory()->create();        
        $response = $this->json('DELETE', 'api/payment/'.$payment->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can restore soft deleted payment .
     *
     * @return void
     */
    public function test_can_restore_payment()
    {       
       $payment =  payment::factory()->create() ;
                
        $response = $this->json('DELETE', 'api/payment/'. $payment->id); 
        $response = $this->json('GET', 'api/payment/restore/'.$payment->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can parmanently delete an payment .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_payment()
    {       
       $payment =  payment::factory()->create();
                
        $response = $this->json('DELETE', 'api/payment/'. $payment->id); 
        $response = $this->json('GET', 'api/payment/parmanently-delete/'.$payment->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

}
