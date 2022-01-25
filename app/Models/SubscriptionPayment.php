<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPayment extends Model
{
    use HasFactory;   
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'customer_name',
        'email',
        'phone',
        'currency',
        'customer_id',
        'paid',
        'payment_intent',
        'payment_method',
        'card_type',
        'reciept_url',
        'reciept_email',
        'reciept_number',
        'status',
        'amount_paid',
        'package_type',
        'package_period',
        'reconciled',
        'reconciled_at',
        'reconciled_to',
        'registration_expiry',
        'registration_date',
        'deleted_at'
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
