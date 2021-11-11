<?php

namespace App\Http\Controllers\Api\QrCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QrCode;
use App\Events\QrCode\qrCodeCreated;
use App\Events\QrCode\qrCodeUpdated;
use App\Events\QrCode\qrCodeDestroyed;
use App\Http\Requests\QrCode\ValidateQrCode;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qrCode = QrCode::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of qrCodes',
            'data'=>$qrCode], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateQrCode  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateQrCode $request)
    {
        $data = $request->validated();        
        $qrCode = QrCode::create($data);
        event(new qrCodeCreated($qrCode));
        return response()->json([
            'success'=> true,
            'message'=> 'qrCode created successfuly',
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
        $qrCode = QrCode::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single qrCode retrieved successfully', 
            'data'=>$qrCode], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request/ValidateQrCode  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateQrCode $request, $id)
    {
        $data = $request->validated();
        $qrcode = Qrcode::findOrFail($id)->update($data);
        event(new qrcodeUpdated($qrcode));
        return response()->json([
            'success'=> true, 
            'message'=>'qrcode updated successfuly', 
            'data'=>$qrcode],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qrCode = QrCode::findOrFail($id)->delete();
        event(new qrCodeDestroyed($qrCode));
        return response()->json([
            'success'=> true, 
            'message'=> 'qrCode deleted successfuly', 
            'data'=>$qrCode], 200);
    }

    /**
     * Display a listing of the soft deleted resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchDeleted()
    {
         $qrCode = QrCode::onlyTrashed()->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of deleted qrCodes',
            'data'=>$qrCode], 200);
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
        $qrCoder = QrCode::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'qrCoder restored successfully', 
            'data'=>$qrCoder],  200);
    }

     /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $qrCode = QrCode::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new qrCodeDestroyed($qrCode)); 
        return response()->json([
            'success' => true,
            'message' => 'qrCode parmanently deleted!',
            'data' => $qrCode
        ], 200);
    }

}
