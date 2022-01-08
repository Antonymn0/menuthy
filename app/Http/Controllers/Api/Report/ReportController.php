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
     * @params should be 'today' and 'all' by default
     */
    public function fetchCustomReportOrders($restaurant_id, $period, $order_type, $table_number, $order_status){
        $orders = [];
        $start_date = $this->getDateRange($period);

        if(isset($restaurant_id)){
            // if all cases 'today' 'all' return orders today by default 
            if( $period == 'today' && $order_type == 'all' && $table_number == 'all' && $order_status =='all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id)        
                ->whereBetween('created_at', [$start_date, Carbon::now()])           
                ->get(); 
            } 

            // if all params are not set to their defaults,  return search records for all
            if(  $order_type !== 'all' && $table_number !== 'all' && $order_status !=='all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id)        
                ->whereBetween('created_at', [$start_date, Carbon::now()])  
                ->where('order_type', $order_type)  
                ->where('table_number', $table_number)           
                ->where('status', $order_status)           
                ->get(); 
            }              
            //if order type not set to default but all others are            
            if( $order_type !== 'all'  && $order_status =='all' && $table_number == 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id)        
                ->whereBetween('created_at', [$start_date, Carbon::now()])
                ->where('order_type', $order_type)              
                ->get(); 
            }
            // if order status not 'all' but other params are return search result
            if(  $order_type == 'all'  && $order_status !=='all' && $table_number == 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id)        
                ->whereBetween('created_at', [$start_date, Carbon::now()]) 
                ->where('status', $order_status)               
                ->get(); 
            }
            // if date range not default but other params are return records in date range
            if(  $order_type == 'all'  && $order_status =='all' && $table_number == 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id)        
                ->whereBetween('created_at', [$start_date, Carbon::now()])                
                ->get(); 
            }
            // if table number is not default but other params are return tables search 
            if(  $order_type == 'all'  && $order_status =='all' && $table_number !== 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id) 
                ->whereBetween('created_at', [$start_date, Carbon::now()])        
                ->where('table_number', $table_number)                
                ->get(); 
            }
            // if order type and order status are not default but other params are other
            if(  $order_type !== 'all'  && $order_status !=='all' && $table_number == 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id) 
                ->whereBetween('created_at', [$start_date, Carbon::now()])        
                ->where('status', $order_status)  
                ->where('order_type', $order_type)               
                ->get(); 
            }
            // if order status and date range are not default but other params are other
            if(  $order_type == 'all'  && $order_status !=='all' && $table_number == 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id) 
                ->whereBetween('created_at', [$start_date, Carbon::now()])        
                ->where('status', $order_status)               
                ->get(); 
            }
            // if date range and table number are default but others are
            if(  $order_type !== 'all'  && $order_status !=='all' && $table_number == 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id) 
                ->whereBetween('created_at', [$start_date, Carbon::now()])        
                ->where('status', $order_status)               
                ->get(); 
            }
            // if only order type default
            if(  $order_type == 'all'  && $order_status !=='all' && $table_number !== 'all'){
                $orders = Order::WHERE('restaurant_id', $restaurant_id) 
                ->whereBetween('created_at', [$start_date, Carbon::now()])        
                ->where('status', $order_status)               
                ->where('table_number', $table_number)              
                ->get(); 
            }

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
        $start_date = null;        
        if($period == 'today') $start_date = Carbon::today();
        if($period == 'yesterday') $start_date = Carbon::today()->subDays(1);
        if($period == 'last 3 days') $start_date = Carbon::now()->subDays(3);
        if($period == 'last 7 days') $start_date = Carbon::now()->subDays(7);
        if($period == 'last 30 days') $start_date = Carbon::now()->subDays(30);
        if($period == 'last 90 days') $start_date = Carbon::now()->subDays(90);
        return $start_date;

    }

 
}
