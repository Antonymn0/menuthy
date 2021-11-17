<?php

namespace App\Http\Controllers\Api\QrCode;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Inertia\Inertia;


class QrCodeGenerateController extends Controller
{
   public function index()
    {
    	return view('qrcode');
    }
    
    public function generate()
    {
            // return qr code link info to be encoded in the front end
        return "menuthy.herokuapp.com";

    }
}
