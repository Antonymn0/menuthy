<?php

namespace App\Http\Controllers\Web\QrCodeScans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Restaurant;
use App\Models\QrCodeScan;

class QrCodeScansController extends Controller
{
    /**
     * fetch single restaurant scans 
     *
     * @return \Illuminate\Http\Response
     */
    public function getRestaurantScans($restaurant_id)
    { 
        $scans = Restaurant::with(['QrCodeScans'])
                        ->where('id', $restaurant_id)
                        ->first();
        return response()->json([
                'success'=> true,
                'message'=> 'Single restaurant scans fetched',
                'data'=> $scans ], 200);
    }

   
}
