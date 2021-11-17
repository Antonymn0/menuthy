<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Inertia\Inertia;

use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QrCodeController extends Controller
{
   public function index()
    {
    	return view('qrcode');
    }
    
    public function create()
    {
     $qrCode =  QrCode::generate('Make me into a QrCode!');
     
    }
}
