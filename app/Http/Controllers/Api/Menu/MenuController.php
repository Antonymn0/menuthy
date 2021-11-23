<?php

namespace App\Http\Controllers\Api\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Events\Menu\menuCreated;
use App\Events\Menu\menuUpdated;
use App\Events\Menu\menuDestroyed;
use App\Http\Requests\Menu\ValidateMenu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of menus',
            'data'=>$menus], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateMenu  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateMenu $request)
    {
        $data = $request->validated(); 
        if($request->hasFile('image')){  
            $file = $request->file('image') ;
        //    $path = Storage::disk('public')->putFile('/images', $file);

            $fileName = now()->timestamp . $file->getClientOriginalName()  ;
            $extension = $file->extension();
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$fileName);

        //    $path = $request->file('image')->store('public');
        //    $path = substr($path,7); //Trunchate out the 'public/' part and remain with only file name.
        $path = $fileName ;
           $data['image'] = $path;
        } 

        $menu = Menu::create($data);
        event(new menuCreated($menu));
        return response()->json([
            'success'=> true,
            'message'=> 'Menu created successfuly',
            'data'=> true,
            ],  201);
    }

    /**
     * duplicate a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\
     * @return \Illuminate\Http\Response
     */
    public function duplicate($id)   
    {
        $menu = Menu::findOrFail($id);
        $newMenu = $menu->replicate();
        $newMenu->save();
        return response()->json([
            'success'=> true,
            'message'=> 'Menu created successfuly',
            'data'=> true,
            ],  201);
    }

    /**
     * toggle publish field.
     *
     * @param  \Illuminate\Http\Request\
     * @return \Illuminate\Http\Response
     */
    public function togglePublished($id, $value)   
    {       
        Menu::where("id", $id)
        ->update(['published'=> $value]);
        return response()->json([
            'success'=> true,
            'message'=> 'Menu publish toggled',
            'data'=> true,
            ],  200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu= Menu::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single menu retrieved successfully', 
            'data'=>$menu], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateMenu  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateMenu $request, $id)
    {
        $data = $request->validated(); 
        if($request->hasFile('image')){            
           $path = $request->file('image')->store('public');
           $path = substr($path,7); //Trunchate out the 'public/' part and remain with only file name.
           $data['image'] = $path;
        }
         if(isset($request->duplicate)){
             $data['image'] = $request->image;
         } 
         
        Menu::findOrFail($id)->update($data);
        $menu = Menu::findOrFail($id);
        event(new menuUpdated($menu));
        return response()->json([
            'success'=> true, 
            'message'=>'Menu updated successfuly', 
            'data'=>$menu],  200);           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id)->delete();
        event(new menuDestroyed($menu));
        return response()->json([
            'success'=> true, 
            'message'=> 'Menu deleted successfuly', 
            'data'=>$menu], 200);
    }

    /**
     * Restore the specified resource back into storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore( $id)
    {
        $menu = Menu::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'Menu restored successfully', 
            'data'=>$menu],  200);
    }

    /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $menu = Menu::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new menuDestroyed($menu)); 
        return response()->json([
            'success' => true,
            'message' => 'Menu parmanently deleted!',
            'data' => $menu
        ], 200);
    }
}
