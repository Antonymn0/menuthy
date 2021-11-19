<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\SubMenu;
use App\Models\Menu;

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
        'is_signiture',
        'is_new',
        'publish',
        'allergy_warning',
        'price',
        'discount',
        'preparation_time',
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

  

    // eloquent relation
    //gets submenus
    public function SubMenu(){
        return $this->belongsTo(SubMenu::class,'sub_menu_id', 'id');
    }

     
}


