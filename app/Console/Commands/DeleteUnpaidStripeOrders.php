<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\Orderitems;
use carbon\Carbon;

class DeleteUnpaidStripeOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UnpaidStripeOrders:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all unpaid stripe orders that are more than 2 days old';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $from = Carbon::today()->subDays(7);
        $to = Carbon::today();
        $date = carbon::today()->subDays(2);

        $orders = Order::whereBetween('created_at', [$from, $to])->get();

        foreach ($orders as $order) {
            // delete unpaid stripe orders older than 2 days
            if($order->payment_method == 'stripe' && $order->paid == 'false'){                
                if($order->created_at->lessThanOrEqualTo($date)){
                    $order_items = OrderItems::where('order_id', $order->id)->get();
                    // delete order items
                    foreach ($order_items as $order_item) {
                        $order_item->delete();
                    }
                    $order->delete();
                } 
            }
        }
    }
}
