<?php

namespace App\Http\Controllers\Api\QrCodeScan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QrCodeScan;
use Carbon\Carbon;

class QrCodeScanController extends Controller
{
       /**
     * count the qr code scans for the clientss
     * 
     * @param  $restaurant_id
     * @return \Illuminate\Http\Response
     */
    public function countQrCodeScan($restaurant_id)
    {
        $week_no = $this->getWeekNumber();
        $qrScan = QrCodeScan::WHERE('restaurant_id', $restaurant_id)->first();
        if(isset($qrScan)){
            $qrScan->$week_no += 1 ;
            $qrScan->save();
        }else{
            QrCodeScan::create([
                'restaurant_id' => $restaurant_id,
                $week_no => 1,
            ]);
        }

        return response()->json([
            'success'=> true,
            'message'=> 'Qr scan recorded successfuly',
            'data'=> true,
            ],  200);
    }

    //Determine week number of the year
    public function getWeekNumber(){

        return 'week'. Carbon::now()->week();
    }
}
