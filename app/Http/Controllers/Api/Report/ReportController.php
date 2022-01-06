<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;

class ReportController extends Controller
{
    /**
     * render reports page
     */
    public function reportsPage(){
        return Inertia::render('Reports/Report');
    }


    /**
     * get all orders and return them for reporting
     */
    public function fetchReportOrders($resturant_id){
        
    }
}
