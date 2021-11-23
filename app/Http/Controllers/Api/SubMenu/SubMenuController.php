<?php

namespace App\Http\Controllers\Api\SubMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubMenu;
use App\Events\SubMenu\subMenuCreated;
use App\Events\SubMenu\subMenuUpdated;
use App\Events\SubMenu\subMenuDestroyed;
use App\Http\Requests\SubMenu\ValidateSubMenu;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subMenu = SubMenu::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of subMenus',
            'data'=>$subMenu], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateSubMenu  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateSubMenu $request)
    {  
         $data = $request->validated(); 
        if($request->hasFile('image')){  
            $file = $request->file('image') ;
            $fileName = now()->timestamp . $file->getClientOriginalName()  ;
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$fileName);
        $path = $fileName ;
        $data['image'] = $path;
        } 

        $subMenu = SubMenu::create($data);
        event(new subMenuCreated($subMenu));
        return response()->json([
            'success'=> true,
            'message'=> 'SubMenu created successfuly',
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
        $menu = SubMenu::findOrFail($id);
        $newMenu = $menu->replicate();
        $newMenu->save();
        return response()->json([
            'success'=> true,
            'message'=> 'sub Menu duplicated successfuly',
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
        $subMenu= SubMenu::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single subMenu retrieved successfully', 
            'data'=>$subMenu], 200);
    }

    /**
     * toggle publish the specified resource.
     *
     * @param  int  $id $value
     * @return \Illuminate\Http\Response
     */
    public function togglePublish($id, $value)
    {
        SubMenu::where("id", $id)
        ->update(['publish'=> $value]);
        return response()->json([
            'success'=> true,
            'message'=> 'Sub menu publish toggled',
            'data'=> true,
            ],  200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateSubMenu  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateSubMenu $request, $id)
    {
         $data = $request->validated(); 
        if($request->hasFile('image')){  
            $file = $request->file('image') ;
            $fileName = now()->timestamp . $file->getClientOriginalName()  ;
            $destinationPath = public_path().'/images' ;
            $file->move($destinationPath,$fileName);
        $path = $fileName ;
        $data['image'] = $path;
        } 

        SubMenu::findOrFail($id)->update($data);
        $subMenu = SubMenu::findOrFail($id);
        event(new subMenuUpdated($subMenu));
        return response()->json([
            'success'=> true, 
            'message'=>'SubMenu updated successfuly', 
            'data'=>true],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subMenu = SubMenu::findOrFail($id)->delete();
        event(new subMenuDestroyed($subMenu));
        return response()->json([
            'success'=> true, 
            'message'=> 'SubMenu deleted successfuly', 
            'data'=>$subMenu], 200);
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
        $subMenu = SubMenu::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'SubMenu restored successfully', 
            'data'=>$subMenu],  200);
    }

    /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $subMenu = SubMenu::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new subMenuDestroyed($subMenu)); 
        return response()->json([
            'success' => true,
            'message' => 'SubMenu parmanently deleted!',
            'data' => $subMenu
        ], 200);
    }

}
