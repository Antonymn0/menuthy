<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Restaurant\restaurantCreated;
use App\Events\Restaurant\restaurantUpdated;
use App\Events\Restaurant\restaurantDestroyed;
use App\Http\Requests\Restaurant\ValidateRestaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurant = Restaurant::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of restaurants',
            'data'=>$restaurant], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateRestaurant  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateRestaurant $request)
    {
        $data = $request->validated();        
        $restaurant = Restaurant::create($data);
        event(new restaurantCreated($restaurant));
        return response()->json([
            'success'=> true,
            'message'=> 'Restaurant created successfuly',
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
        $restaurant = Restaurant::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single restaurant retrieved successfully', 
            'data'=>$restaurant], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\validateRestaurant  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateRestaurant $request, $id)
    {     
        $data = $request->validated();

        $restaurant = Restaurant::findOrFail($id)->update($data);
        event(new restaurantUpdated($restaurant));
        return response()->json([
            'success'=> true, 
            'message'=>'Restaurant updated successfuly', 
            'data'=>$restaurant],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id)->delete();
        event(new restaurantDestroyed($restaurant));
        return response()->json([
            'success'=> true, 
            'message'=> 'Restaurant deleted successfuly', 
            'data'=>true], 200);
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
        $restaurant = Restaurant::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'Restaurant restored successfully', 
            'data'=>$restaurant],  200);
    }

     /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $restaurant = Restaurant::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new restaurantDestroyed($restaurant)); 
        return response()->json([
            'success' => true,
            'message' => 'Restaurant parmanently deleted!',
            'data' => $restaurant
        ], 200);
    }

}
