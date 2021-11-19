<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SubMenu;
use App\Models\Restaurant;

class Menu extends Model
{
     use HasFactory;   
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'menu_name',
        'category',
        'restaurant_id',
        'availability',
        'take_away',
        'in_house',
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

    // eloquent <relation
    //gets menu items
    public function SubMenu(){
        return $this->hasMany(SubMenu::class,'menu_id', 'id');
    }

 // eloquent <relation
    //gets menu items
    public function Restaurant(){
        return $this->belongsTo(Restaurant::class,'restaurant_id', 'id');
    }

}
