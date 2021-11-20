<?php

namespace App\Http\Controllers\Web\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\Restaurant;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Restaurant::WHERE('user_id', Auth::user()->id)->first() ;

        $menus = Menu::with('SubMenu')->WHERE('restaurant_id', $restaurant->id)->get();

        return Inertia::render('Menus/Menus',['menus' =>  $menus, 'restaurant_id' => $restaurant->id] );
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {     
        $restaurant = Restaurant::WHERE('user_id', Auth::user()->id)->first() ;
        $menu = Menu::findOrFail($id);
        $subMenus = SubMenu::with('Menu')
                        ->WHERE('menu_id', $id)
                        ->get();

        return Inertia::render('SubMenu/SubMenu', [
            'subMenus'=> $subMenus , 
            'restaurant_id' => $restaurant->id,
            'menu' => $menu,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }



}
