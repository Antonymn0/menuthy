<?php

namespace App\Http\Controllers\Api\MenuItem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Events\MenuItem\menuItemCreated;
use App\Events\MenuItem\menuItemUpdated;
use App\Events\MenuItem\menuItemDestroyed;
use App\Http\Requests\MenuItem\ValidateMenuItem;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuItems = MenuItem::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of menuItem',
            'data'=>$menuItems], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateMenuItem  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateMenuItem $request)
    {
        $data = $request->validated();  
         
        if($request->hasFile('image')){            
           $path = $request->file('image')->store('public');
           $path = substr($path,7); //Trunchate out the 'public/' part and remain with only file name.
           $data['image'] = $path;
        }     
        $menuItem = MenuItem::create($data);
        event(new menuItemCreated($menuItem));
        return response()->json([
            'success'=> true,
            'message'=> 'MenuItem created successfuly',
            'data'=> true,
            ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single menuItem retrieved successfully', 
            'data'=>$menuItem], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateMenuItem  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateMenuItem $request, $id)
    {
        $data = $request->validated();
        $menuItem = MenuItem::findOrFail($id)->update($data);
        event(new menuItemUpdated($menuItem));
        return response()->json([
            'success'=> true, 
            'message'=>'MenuItem updated successfuly', 
            'data'=>$menuItem],  200);
    }

    /**
     * Softdelete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItem = MenuItem::findOrFail($id)->delete();
        event(new menuItemDestroyed($menuItem));
        return response()->json([
            'success'=> true, 
            'message'=> 'MenuItem deleted successfuly', 
            'data'=>$menuItem], 200);
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
        $meniItem = MenuItem::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'MeniItem restored successfully', 
            'data'=>$meniItem],  200);
    }

     /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $menuItem = MenuItem::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new menuItemDestroyed($menuItem)); 
        return response()->json([
            'success' => true,
            'message' => 'MenuItem parmanently deleted!',
            'data' => $menuItem
        ], 200);
    }
}
