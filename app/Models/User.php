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
        'registration_status',
        'package_type',
        'trial_expiry',
        'registration_expiry',
        'phone',
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
        'regn_status',
        'suspended_by',
        'avatar',
        'name'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     */
    public function restaurant(){

        $restaurant = Restaurant::WHERE('user_id', Auth::user()->id)->first();
// dd($restaurant);
        if( $restaurant ){
            return $restaurant;
        }

        return null;
    }

}
