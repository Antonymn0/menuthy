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
    public function generate($restaurant_id, $table_number=null)
    {
      
        if(isset($restaurant_id) && !isset($table_number)){

            //return plain restaurant url
           return  $this->makeRestaurantUrl($restaurant_id);
        }

        if(isset($restaurant_id) && isset($table_number)){

            // return url with table number
            return $this->makeRestaurantUrl($restaurant_id) .'/'. $table_number;
        }

       return null;

    }

    /**
     * Make dynamic urls for restaurants
     * 
     * @param $restaurant_id
     * 
     * @return string $url
     */
    public function makeRestaurantUrl($restaurant_id){
        
        $restaurant= Restaurant::findOrFail($restaurant_id);
        $restaurantName = strtolower($restaurant->restaurant_name) ;
        $restaurantName = str_replace(" ", "-", $restaurantName);  // replace spaces with hyphens

        $qrCode = $restaurantName .  '/menu/'. $restaurant_id;

        return url($qrCode);
    }
}
