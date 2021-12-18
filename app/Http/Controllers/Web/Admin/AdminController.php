<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Restaurant;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('getRestaurant')->paginate(ENV('API_PAGINATION',10));
        return Inertia::render('SuperAdmin/Dashboard',['users'=> $users]);
    }

    /**
     * return clients portal info.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientsPortal()
    {
       return Inertia::render('SuperAdmin/Clients/Portal');
    }

    
     /**
     * get deleted users from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDeletedUsers( )
    {
        $user = User::with('getRestaurant')->onlyTrashed()->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true, 
            'message'=>'User restored', 
            'data'=>$user],  200);
    }

    /**
     * get all site admins.
     * 
     */
    public function allAdmins()
    {
        $admins = User::where('role', 'admin')->paginate(ENV('API_PAGINATION',10));
        return Inertia::render('SuperAdmin/AllAdmins',['users'=> $admins]);
    }


}
