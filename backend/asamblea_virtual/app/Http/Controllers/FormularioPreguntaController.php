<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FormularioPregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormularioPreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([FormularioPregunta::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pregunta = new FormularioPregunta();

        $pregunta->formulario_detalle_id = $request->formulario_detalle_id;
        $pregunta->temario_id = $request->temario_id;

        $pregunta->save();
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


        // $frmPregunta = DB::select('select 

        // `formulario_detalle`.`id` as formulario_detalle_id, 
        // `formulario_detalle`.`nombre_formulario`, 


        // `formulario_preguntas`.`formulario_detalle_id`, 
        // `formulario_preguntas`.`temario_id`,
        // `temarios`.`id` as temario_id , 
        // `temarios`.`nombre` as temario_nombre,
        // `temarios`.`posicion`,
        // `temarios`.`estado_temario_id`,
        // `opciones`.`id` as opciones_id, 
        // `opciones`.`nombre` as opciones_nombre,
        // `opcion_temario`.`id` as opcion_temario_id, 
        // `opcion_temario`.`temario_id`,
        // `opcion_temario`.`opcion_id`

        // from 
        // `formulario_detalle` inner join `formulario_preguntas` 
        // on `formulario_detalle`.`id` = `formulario_preguntas`.`formulario_detalle_id` 


        // inner join `temarios` 
        // on `formulario_preguntas`.`temario_id` = `temarios`.`id` 
        // inner join `opcion_temario` 
        // on `temarios`.`id` = `opcion_temario`.`temario_id`

        // inner join `opciones` 
        // on `opcion_temario`.`opcion_id` = `opciones`.`id`



        // where `formulario_detalle_id` = ?', [$id]);

        $opciones = [];

        $frmPregunta  = DB::select('
        
        select 
        `formulario_preguntas`.`formulario_detalle_id`, 
        `formulario_preguntas`.`temario_id`
        from 
        `formulario_detalle` inner join `formulario_preguntas` 
        on `formulario_detalle`.`id` = `formulario_preguntas`.`formulario_detalle_id` 
        where `formulario_detalle_id` = ?', [$id]);
   
        foreach ($frmPregunta as $opc) {

            $opcion  = DB::select('select `opciones`.`nombre` as nombre_opcion, `opciones`.`id` as opcion_id, temarios.id, temarios.nombre as nombre_termario, `opciones`.`type`
                from 
                `opcion_temario` inner join `opciones` 
                on `opcion_temario`.`opcion_id` = `opciones`.`id` 
                inner join temarios
                on opcion_temario.temario_id = temarios.id
            
                where `opcion_temario`.`temario_id` = ?',[$opc->temario_id] );
            $opcion['formulario_id'] = $opc->formulario_detalle_id;

            $opciones[] = $opcion;
    
        }

        //dd($opciones[0]['formulario_id']);
        return response()->json($opciones);
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
        $pregunta =  FormularioPregunta::find($id);
        $pregunta->update($request->all());
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
        $pregunta = FormularioPregunta::find($id);
        $pregunta->delete();
        return response()->json(['delete' => true, 'datos eliminados'], 200);
    }
}
