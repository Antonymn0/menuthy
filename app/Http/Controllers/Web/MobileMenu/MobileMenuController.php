<?php

namespace App\Http\Controllers\Web\MobileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\User;
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
        $user = $this->makeSafeUser($restaurant_id);
                //get menus
        $menus = Menu::WHERE('restaurant_id', $restaurant_id)->get();

            if(count($menus)){
                    // get sub menus of the first Menu
                $subMenus  = SubMenu::WHERE('menu_id',$menus[0]->id)->get();
            if(count($subMenus)){
                        // get menu items of the first submenu
                $menuItems = MenuItem::WHERE('sub_menu_id',$subMenus[0]->id)->get();
                return Inertia::render('MobileMenu/MenuView')->with([
                    'menus'=>$menus,
                    'subMenus'=>$subMenus,
                    'menuItems'=>$menuItems,
                    'user'=> $user,
                    ]);
            }
        }
        // else return empty array 
         return Inertia::render('MobileMenu/MenuView')->with([
                    'menus'=>[],
                    'subMenus'=>[],
                    'menuItems'=>[],
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

   /**
    *   construct safe public user object to send with the menus
    * @param $restaurant_id

    * @return safe user object
    */
    private function makeSafeUser($restaurant_id){
          if(isset($restaurant_id))  $restaurant = Restaurant::where('id', $restaurant_id)->first() ;
            
           if(isset($restaurant)){
               $restaurant_owner = User::where('id', $restaurant->id)->first();
               //create safe user
            $user = new \stdClass();
            
            $user->package_type = $restaurant_owner->package_type;
            $user->registration_expiry = $restaurant_owner->registration_expir;
            $user->trial_expiry = $restaurant_owner->trial_expiry;
            $user->city = $restaurant_owner->city;
            $user->timezone = $restaurant_owner->timezone;

            return $user;
           } 

        //    else return exception 404 not found
        throw new Exception('Restaurant or user not found'); 


            
            
    }
    
}
