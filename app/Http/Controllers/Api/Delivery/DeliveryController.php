<?php

namespace App\Http\Controllers\Api\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeliveryController extends Controller
{
     public function deliveryPage(){
        return Inertia::render('Orders/Users/Delivery/Delivery');
    }
}
