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
     * Initialy display a listing of menus on mobile/tablet menu.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMainMenu($restaurant_name, $restaurant_id, $table_number=null)
    {       
        $user = $this->makeSafeUser($restaurant_id, $table_number);

                //get all menus
        $menus = Menu::WHERE('restaurant_id', $restaurant_id)->get();

            if(count($menus)){
                // get all sub menus of the first Menu item
                $subMenus  = SubMenu::WHERE('menu_id',$menus[0]->id)->get();

                // if(isset($menu_id)) $subMenus  = SubMenu::WHERE('menu_id',$menu_id)->get();

                if(count($subMenus)){
                    // get all menu items of the first submenu item
                    $menuItems = MenuItem::WHERE('sub_menu_id',$subMenus[0]->id)->get();
                    return Inertia::render('MobileMenu/MenuView')->with([
                        'menus'=>$menus,
                        'subMenus'=>$subMenus,
                        'menuItems'=>$menuItems,
                        'user'=> $user['user'],
                        'restaurant'=> $user['restaurant'],
                        ]);
                }
            }
        // else return empty array 
         return Inertia::render('MobileMenu/MenuView')->with([
                    'menus'=>[],
                    'subMenus'=>[],
                    'menuItems'=>[],
                    'user'=> $user['user'],
                    'restaurant'=> $user['restaurant'],
                    ]);
    }


/**
 * get a single main menu with the sub mneus and menu items
 */
public function getOneMainMenu($restaurant_name, $menu_id){
             $menu = Menu::WHERE('id', $menu_id)->first();
                
             $user = $this->makeSafeUser($menu->restaurant_id, $table_number=null);

             $menus = Menu::WHERE('restaurant_id',$menu->restaurant_id )->get();
             
             if(isset($menu)){
                  $subMenus  = SubMenu::WHERE('menu_id',$menu->id)->get();
                  if(count($subMenus)){
                      $menuItems = MenuItem::WHERE('sub_menu_id',$subMenus[0]->id)->get();
                      
                      return Inertia::render('MobileMenu/MenuView')->with([
                        'menus'=>$menus,
                        'subMenus'=>$subMenus,
                        'menuItems'=>$menuItems,
                        'user'=> $user['user'],
                        'restaurant'=> $user['restaurant'],
                        ]);
                  }
             }
              // else return empty array 
         return Inertia::render('MobileMenu/MenuView')->with([
                    'menus'=>$menus,
                    'subMenus'=>[],
                    'menuItems'=>[],
                    'user'=> $user['user'],
                     'restaurant'=> $user['restaurant'],
                    ]);
}

/**
 * get a single main menu with the sub mneus and menu items
 */
public function fetchMainMenu($restaurant_name, $menu_id){
             $menu = Menu::WHERE('id', $menu_id)->first();
                
             $user = $this->makeSafeUser($menu->restaurant_id, $table_number=null);

             $menus = Menu::WHERE('restaurant_id',$menu->restaurant_id )->get();
             
             if(isset($menu)){
                  $subMenus  = SubMenu::WHERE('menu_id',$menu->id)->get();
                  if(count($subMenus)){
                      $menuItems = MenuItem::WHERE('sub_menu_id',$subMenus[0]->id)->get();
                      
                      return response()->json([
                        'menus'=>$menus,
                        'subMenus'=>$subMenus,
                        'menuItems'=>$menuItems,                       
                        ], 200);
                  }
             }
              // else return empty array 
         return response()->json([
                    'menus'=>$menus,
                    'subMenus'=>[],
                    'menuItems'=>[],
                    'user'=> $user['user'],
                    'restaurant'=> $user['restaurant'],
                    ], 200);
}

    /**
     * when a user clicks on a main menu link he gets a list of sub menus back 
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
     * When the user clicks on sub menu he get a list of menu items back
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
    *   Construct safe public user object to send with the menus
    * @param $restaurant_id

    * @return safe user object
    */
    private function makeSafeUser($restaurant_id, $table_number=null){
        
          if(isset($restaurant_id))  $restaurant = Restaurant::where('id', $restaurant_id)->first() ;
            
           if(isset($restaurant)){
               $restaurant_owner = User::where('id', $restaurant->user_id)->first();

               if($restaurant_owner){
                    //create a safe user object with only nessesary details if user exists
                    $user = new \stdClass();
                    
                    $user->package_type = $restaurant_owner->package_type;
                    $user->registration_status = $restaurant_owner->registration_status;
                    $user->registration_expiry = $restaurant_owner->registration_expiry;
                    $user->trial_expiry = $restaurant_owner->trial_expiry;
                    $user->city = $restaurant_owner->city;
                    $user->timezone = $restaurant_owner->timezone;
                    $user->stripe_publishable_key = $restaurant_owner->stripe_publishable_key;

                    //pass table number to user object if isset() true
                    if(isset($table_number)) $user->table_number = $table_number;  
                    if($table_number == 0) $user->table_number = 0;  

                    return ['user' =>$user, 'restaurant' => $restaurant];
               }
            } 

        //    else return exception 404 not found
        return 'Restaurant or user not found'; 


            
            
    }
    
}
