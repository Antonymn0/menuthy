<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     use HasFactory;   


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        
       'order_number',
        'order_id',
        'menu_item_id',
        'item_name',
        'price_per_item',
        'quantity',
        'amount',
        'preparation_time'


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
    //gets order 
    public function Order(){
        return $this->belongsTo(Order::class,'order_id', 'id');
    }
}

