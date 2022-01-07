<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use Carbon\Carbon;

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
     * get all orders and return them for reporting includiong searches
     */
    public function fetchSummayReportOrders($restaurant_id){        
        // get current year records by default 
        $orders = Order::WHERE('restaurant_id', $restaurant_id)        
                ->whereBetween('created_at', [Carbon::now()->startOfYear(),Carbon::now()->endOfYear()])
                ->get();            
        return response()->json([
            'success' => true,
            'message' => 'Orders retrieved successfully',
            'data' => $orders
        ]);
    }

    /**
     * get all orders and return them for reporting includiong searches
     */
    public function fetchCustomReportOrders($restaurant_id, $period, $order_type, $table_number, $order_status){  
        $orders = [];
        $start_date = Carbon::yesterday();
        if($restaurant_id ){
            // get today records by default 
            $orders = Order::WHERE('restaurant_id', $restaurant_id)        
                ->whereBetween('created_at', [$start_date, Carbon::today()])
               
                ->get(); 
        }  
        else{
            return response()->json([
                'success' => false,
                'message' => 'Restaurant not set',
                'data' => []
            ]);
        }
                   
        return response()->json([
                'success' => true,
                'message' => 'Orders retrieved successfully',
                'data' => $orders
            ]);
    }

/**
 * get date range for filters
 */
    public function getDateRange($period){        
        $start_date = Carbon::yesterday();
        if($period == 'yesterday') $start_date = Carbon::today()->subDays(1);
        if($period == 'last 3 days') $start_date = Carbon::today()->subDays(3);
        if($period == 'last 7 days') $start_date = Carbon::today()->subDays(7);
        if($period == 'last 30 days') $start_date = Carbon::today()->subDays(30);
        if($period == 'last 90 days') $start_date = Carbon::today()->subDays(90);
        return $start_date;

    }

 
}
