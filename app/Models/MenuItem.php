<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
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
        'availability',
        'take_away',
        'sub_menu_id',
        'inhouse',
        'price',
        'discount',
        'preperation_time',
        'available_days',
        'slang',
        'description',
        'image',
        'avatar',
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


