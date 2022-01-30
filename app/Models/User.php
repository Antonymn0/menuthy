<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'full_name',
        'first_name',
        'middle_name',
        'last_name',
        'user_name',
        'email',
        'package_period',
        'trial_date',
        'registration_date',
        'registration_status',
        'package_type',
        'trial_expiry',
        'registration_expiry',
        'phone',
        'role',
        'address',
        'biography',
        'password',
        'dob',
        'county',
        'city',
        'location',
        'suspended_at',
        'suspended_by',
        'email_verified_at',
        'gender',
        'tables',
        'stripe_publishable_key',
        'stripe_secret_key',
        'stripe_info_updated_at',
        'suspended_by',
        'avatar',
        'name',
        'image',
        'created_by'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'stripe_secret_key',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get Users restaurant details
     * 
     * return json
     * 
     */
    public function restaurant(){
        //restaurant owner
        if(Auth::user()->role == 'user'){
            $restaurant = Restaurant::WHERE('user_id', Auth::user()->id)->first();
            if( $restaurant ){
                // get role users of the restaurant ie cashier/kitchen/delievry 
                $restaurant->role_users = User::where('created_by', Auth::user()->id )->get();
                return $restaurant;
            }
        }
        // cashier/kitchen/delivery
        if(Auth::user()->role !== 'user' && Auth::user()->role !== 'admin'){
            $restaurant = Restaurant::WHERE('user_id', Auth::user()->created_by)->first();
            if( $restaurant ){
                return $restaurant;
            }
        }        
        else return null;       
    }

    // eloquent relation
    //gets menu items
    public function getRestaurant(){
        return $this->hasMany(Restaurant::class,'user_id', 'id');
    }

}
