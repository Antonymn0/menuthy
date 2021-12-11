<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Inertia\Inertia;

class QrCodeScansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allScans()
    {
        $scans = Restaurant::with(['QrCodeScans'])->paginate(ENV('API_PAGINATION', 15));
         return Inertia::render('SuperAdmin/QrcodeScans/QrCodeScans')->with([
            'restaurants' => $scans,
        ]);
    }

    /**
     * Search restaurant scans by resaturant name.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchScansByName($restaurant_name)
    {
        $scans = Restaurant::with(['QrCodeScans'])
                        ->where('restaurant_name', $restaurant_name)
                        ->paginate(ENV('API_PAGINATION', 15));
         return response()->json([
            'success'=> true, 
            'message'=>'Scan search by restaurant name complete', 
            'data'=>$scans],  200);
    }

    /**
     * Search restaurant scans by email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchScansByEmail($email)
    {
        $scans = Restaurant::with(['QrCodeScans'])
                    ->where('restaurant_email', $email)
                    ->paginate(ENV('API_PAGINATION', 15));
         return response()->json([
            'success'=> true, 
            'message'=>'Scan search by restaurant email complete', 
            'data'=>$scans],  200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
