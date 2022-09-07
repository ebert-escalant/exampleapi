<?php

namespace App\Http\Controllers;

use App\Models\TPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person=TPerson::create([
            'idperson'=>uniqid(),
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'dni'=>$request->dni
        ]);
        return response()->json(['message'=>'correct process','data'=>$person]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TPerson  $tPerson
     * @return \Illuminate\Http\Response
     */
    public function show(TPerson $tPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TPerson  $tPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ini_set('max_execution_time', 20); //3 minutes
        $request->validate([

        ]);
        DB::beginTransaction();
        try {
            
            $person=TPerson::lockForUpdate()->find($id);
            //$person=Person::where('id',$id)->lockForUpdate()->get()->first();
            
            $person->update([
                'nombre'=>$request->nombre,
                'apellido'=>$request->apellido,
                'dni'=>$request->dni,
            ]);
            $message="actualizacion exitosa";
            sleep(12);
            DB::commit();
            
        } catch (\Exception $th) {
            DB::rollBack();
            
        }
        return response()->json([['data'=>$person],['message'=>'message']],200);
    }

    public function actionUpdate(Request $request, $id)
    {
        ini_set('max_execution_time', 8); //3 minutes
        $request->validate([
            
        ]);
        //return $request;
        DB::beginTransaction();
        try {
            
            $person=TPerson::lockForUpdate()->find($id);
            //return $person;
            $person->update([
                'nombre'=>$request->nombre,
                'apellido'=>$request->apellido,
                'dni'=>$request->dni,
            ]);
            $message="actualizacion exitosa";
            //sleep(10);
            DB::commit();
            
        } catch (\Exception $th) {
            DB::rollBack();
            
        }
        return response()->json([['data'=>$person],['message'=>'message']],200);
    }
    public function destroy(TPerson $tPerson)
    {
        //
    }
}
