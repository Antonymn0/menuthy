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
    public function summaryReportsPage(){
        return Inertia::render('Reports/SummaryReport');
    }
    /**
     * render reports page
     */
    public function customReportsPage(){
        return Inertia::render('Reports/CustomReports');
    }


    /**
     * get all orders and return them for reporting
     */
    public function fetchReportOrders($restaurant_id, $year=null){
        $orders = Order::WHERE('restaurant_id', $restaurant_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Orders summary retrieved successfully',
            'data' => $orders
        ]);
    }

 
}
