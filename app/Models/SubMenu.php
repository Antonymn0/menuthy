<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\MenuItem;
use App\Models\Menu;

class SubMenu extends Model
{
    use HasFactory;   
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sub_menu_name',
        'sub_menu_type',
        'menu_id',
        'restaurant_id',
        'availability',
        'take_away',
        'is_signiture',
        'is_new',
        'publish',
        'inhouse',
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
    public function Menu(){
        return $this->belongsTo(Menu::class,'menu_id', 'id');
    }
    
    // eloquent <relation
    //gets menu items
    public function MenuItem(){
        return $this->hasMany(MenuItem::class,'sub_menu_id', 'id');
    }
}
