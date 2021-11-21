<?php

namespace App\Http\Controllers\Web\MobileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\MenuItem;
use Inertia\Inertia;
use App\Models\Menu;

class MobileMenuController extends Controller
{
    /**
     * Display a listing of the mobile menu.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMainMenu($restaurant_name, $restaurant_id)
    {       
                //get menus
        $menus = Menu::WHERE('restaurant_id', $restaurant_id)->get();
        
                // get sub menus of the first Menu
        $subMenus  = SubMenu::WHERE('menu_id',$menus[0]->id)->get();
    
                // get munu items of the first submenu
        $menuItems = MenuItem::WHERE('sub_menu_id',$subMenus[0]->id)->get();
        return Inertia::render('MobileMenu/MenuView')->with([
            'menus'=>$menus,
            'subMenus'=>$subMenus,
            'menuItems'=>$menuItems,
            ]);
    }

    /**
     * display submenus
     * 
     * @param $submenu_id
     * 
     * @return json response
     */

   public function getSubMenus($id)   {

        $subMenus  = SubMenu::WHERE('menu_id',$id)->get();

        return response()->json([
            'sucess' => true,
            'message' => 'A list of submenus',
            'data' => $subMenus,

        ]);
   }

    /**
     * get a list of menu items
     * 
     * @param $submenu_id
     * 
     * @return response
     */
   public function getMenuItems($restaurant_name, $id)
   {
       $menuItems = MenuItem::WHERE('sub_menu_id', $id)->get();

       return response()->json([
           'sucess' => true,
            'message' => 'A list of menu items',
            'data' => $menuItems,
       ],200);

   }
    
}
