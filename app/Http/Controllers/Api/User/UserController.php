<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\User\userCreated;
use App\Events\User\userUpdated;
use App\Events\User\userDestroyed;
use App\Http\Requests\User\ValidateUser;
use App\Http\Requests\User\UpdateUser;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Utilities;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public $trial_days = 15;   // set user trial period

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of users',
            'data'=>$users], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateUser $request)
    {       
        $data = $request->validated();

        $user_data = Utilities::createNamesFromFullName($data);
        $user_data['password']  = Hash::make($data['password']);
        $user_data['registration_status'] = 'trial';     // register user on trial by default
       $user_data['trial_expiry'] = $this->trialDays($this->trial_days);

        $user= User::create($user_data);
        event(new userCreated($user));
        return response()->json([
            'success'=> true,
            'message'=> 'User created successfuly',
            'data' => $user,
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
        $user= User::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single user retrieved successfully', 
            'data'=>$user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $data = $request->validated();
        
         $data = $request->validated(); 
        if($request->hasFile('image')){  
           $path = $request->file('image')->store('images', 's3'); // send image to AWS S3         
           \Storage::disk('s3')->setVisibility($path, 'public'); // set file visibility to public
           $path = \Storage::disk('s3')->url($path);  // create file path
        $data['image'] = $path;
        }  
        $user= User::findOrFail($id)->update($data);
        event(new UserUpdated($user));
        return response()->json([
            'success'=> true, 
            'message'=>'User updated successfuly', 
            'data'=>$user],  200);
    }

    /**
     * softdelete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id)->delete();
        event(new UserDestroyed($user));
        return response()->json([
            'success'=> true, 
            'message'=> 'User deleted successfuly', 
            'data'=>$user], 200);
    }

     /**
     * get deleted users from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletedUsers( )
    {
        $user = User::onlyTrashed()->paginate(env('API_PAGINATION', 10));; 
        return response()->json([
            'success'=> true, 
            'message'=>'User restored', 
            'data'=>$user],  200);
    }

     /**
     * Restore the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreUser( $id)
    {
        $user = User::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'User restored', 
            'data'=>$user],  200);
    }

    /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new userDestroyed($user)); 
        return response()->json([
            'success' => true,
            'message' => 'User parmanently deleted!',
            'data' => $user
        ], 200);
    }

    // return trial date function
    public function trialDays($days){

        return Carbon::now()->addDays($days);
    }
    
}
