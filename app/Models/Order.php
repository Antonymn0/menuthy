<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use HasFactory;   
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [        
        'restaurant_id',
        'transaction_id',
        'order_number',
        'cash_collected',
        'amount_collected',
        'cash_collected_at',       
        'amount',
        'paid',
        'amount_paid',
        'paid_at',
        'number_of_items',
        'status',
        'longitude',
        'latitude', 
        'customer_name',
        'customer_phone',
        'car_registration_no',
        'order_type',
        'table_number',
        'delivery_address',
        'deleted_at',
        'completed_at',
        'canceled_at',
        'delivered_at',
        'mode_of_payment',
        'stripe_session_id',
        'stripe_payment_intent_id',
        'reciept_url'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

// eloquent <relation
    //gets order items
    public function OrderItem(){
        return $this->hasMany(OrderItem::class,'order_id', 'id');
    }
}
