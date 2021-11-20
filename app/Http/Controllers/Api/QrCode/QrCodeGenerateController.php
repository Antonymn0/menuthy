<?php

namespace App\Http\Controllers\Api\QrCode;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;


class QrCodeGenerateController extends Controller
{
   public function index()
    {
    	return view('qrcode');
    }
    
     /**
     * creat dinamiv qr code
     * 
     * @ params $restaurant_id
     * 
     * @return unique qr code value
     */
    public function generate($restaurant_id)
    {
      
        if($restaurant_id){
            $restaurant= Restaurant::findOrFail($restaurant_id);
            $restaurantName = strtolower($restaurant->restaurant_name) ;
            $restaurantName = str_replace(" ", "-", $restaurantName);  // replace spaces with hyphens

            $qrCode = $restaurantName .  '/menu/'. $restaurant_id;

            return url($qrCode);
        }
       return null;

    }
}
