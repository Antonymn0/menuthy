<?php

namespace App\Http\Controllers\Api\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Events\Table\tableCreated;
use App\Events\Table\tableUpdated;
use App\Events\Table\tableDestroyed;
use App\Http\Requests\Table\ValidateTable;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of tables',
            'data'=>$tables], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\validateTable  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateTable $request)
    {
        $data = $request->validated();        
        $table = Table::create($data);
        event(new tableCreated($table));
        return response()->json([
            'success'=> true,
            'message'=> 'Table created successfuly',
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
        $table= Table::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single table retrieved successfully', 
            'data'=>$table], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateTable  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateTable $request, $id)
    {
        $data = $request->validated();
        $table = Table::findOrFail($id)->update($data);
        $table = Table::findOrFail($id);
        event(new tableUpdated($table));
        return response()->json([
            'success'=> true, 
            'message'=>'table updated successfuly', 
            'data'=>$table],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::findOrFail($id)->delete();
        event(new tableDestroyed($table));
        return response()->json([
            'success'=> true, 
            'message'=> 'Table deleted successfuly', 
            'data'=>$table], 200);
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
        $table = Table::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'Table restored successfully', 
            'data'=>$table],  200);
    }

     /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $table = Table::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new tableDestroyed($table)); 
        return response()->json([
            'success' => true,
            'message' => 'Table parmanently deleted!',
            'data' => $table
        ], 200);
    }

}
