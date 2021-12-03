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
        'menu_item_name',
        'menu_item_type',
        'menu_item_id',
        'restaurant_id',
        'order_number',
        'is_take_away',
        'is_inhouse',
        'price',
        'order_type',
        'preparation_time',
        'status',
        'table_number',
        'accompaniments',
        'deleted_at',
        'avatar'

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


}
