<?php

namespace App\Http\Controllers\Api\Kitchen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KitchenController extends Controller
{
     public function kitchenPage(){
        return Inertia::render('Orders/Users/Kitchen/Kitchen');
    }
}
