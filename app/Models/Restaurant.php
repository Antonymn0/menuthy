<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Menu;
use App\Models\User;

class Restaurant extends Model
{
    use HasFactory;   
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'restaurant_name',
        'restaurant_type',
        'user_id',
        'country',
        'city',
        'currency',
        'timezone',
        'website',
        'facebook',
        'twitter',
        'youtube',
        'instagram',
        'address',
        'restaurant_phone_number',
        'restaurant_email',
        'is24/7',
        'opening_hrs',
        'closing_hrs',
        'offer_accomodation',
        'slang',
        'description',
        'avatar',
        'image',
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

     // eloquent <relation
    //gets menu items
    public function Menu(){
        return $this->hasMany(Menu::class,'restaurant_id', 'id');
    }

     // eloquent <relation
    //gets menu items
    public function User(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}

