<?php

namespace Tests\Feature\qrCode;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\QrCode;

class QrCodeTest extends TestCase
{
     use RefreshDatabase;
     use WithoutMiddleware;

      /**
     * A basic feature test can fetch qrcodes using GET.
     *
     * @return void
    */
    public function test_can_fetch_qrcodes()
    {
        QrCode::factory()->create() ;
        $response = $this->get('api/qrcode')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can create an qrcode .
     *
     * @return void
     */
    public function test_can_create_qrcode()
    {
        $qrcode = QrCode::factory()->create();
        $data = @json_decode(json_encode(QrCode::factory()->create()), true);
        $response = $this->json('POST', 'api/qrcode/', $data);
        $response ->assertStatus(201)
                ->assertJson([
                    'success' => true,
                ]);
    }

     /**
     * A basic feature test can fetch single qr code using GET.
     *
     * @return void
    */
    public function test_can_fetch_qrcode()
    {
        $qrcode =  QrCode::factory()->create();
        $response = $this->get('api/qrcode/'. $qrcode->id)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

     /**
     * A basic feature test can update a qrcode using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_an_qrcode()
    {       
        QrCode::factory()->create() ;
        $qrcode = QrCode::first();

        $updateData = @json_decode(json_encode($qrcode), true);
        $response = $this->json('PUT', 'api/qrcode/'.$qrcode->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can soft delete an qrcode using DELETE.
     *
     * @return void
     */
    public function test_can_softDelete_an_qrcode()
    {       
        QrCode::factory()->create();
        $qrcode = QrCode::first();
        
        $response = $this->json('DELETE', 'api/qrcode/'.$qrcode->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

      /**
     * A basic feature test can restore soft deleted qrcode .
     *
     * @return void
     */
    public function test_can_restore_qrcode()
    {       
       $qrcode =  QrCode::factory()->create() ;
                
        $response = $this->json('DELETE', 'api/qrcode/'. $qrcode->id); 
        $response = $this->json('GET', 'api/qrcode/restore/'.$qrcode->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }


     /**
     * A basic feature test can parmanently delete an qrcode .
     *
     * @return void
     */
    public function test_can_Parmanently_delete_qrcode()
    {       
       $qrcode =  QrCode::factory()->create();
                
        $response = $this->json('DELETE', 'api/qrcode/'. $qrcode->id); 
        $response = $this->json('GET', 'api/qrcode/parmanently-delete/'.$qrcode->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

}
