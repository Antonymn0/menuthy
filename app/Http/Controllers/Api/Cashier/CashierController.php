<?php

namespace App\Http\Controllers\Api\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CashierController extends Controller
{
    public function cashierPage(){
        return Inertia::render('Orders/Users/Cashier/Cashier');
    }
}
