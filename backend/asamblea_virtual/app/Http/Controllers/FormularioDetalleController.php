<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FormularioDetalle;
use Illuminate\Http\Request;

class FormularioDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(FormularioDetalle::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detalle = new FormularioDetalle();

        $detalle->nombre_formulario = $request->nombre_formulario;
        $detalle->fecha = $request->fecha;
    
        $detalle->save();
        return response()->json(['created' => true, 'datos insertados'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detalle =  FormularioDetalle::find($id);
        return response()->json($detalle);
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
        $detalle =  FormularioDetalle::find($id);
        $detalle->update($request->all());
        return response()->json(['update' => true, 'datos actualizados'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalle = FormularioDetalle::find($id);
        $detalle->delete();
        return response()->json(['delete' => true, 'datos eliminados'], 200);
    }
}
