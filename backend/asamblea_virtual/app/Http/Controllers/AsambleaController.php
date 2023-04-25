<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asamblea;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AsambleaPersona;

class AsambleaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Asamblea::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|min:10',
            'tipo' => 'required|integer',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s'
        ];
        try {
            // Ejecutamos el validador y en caso de que falle devolvemos la respuesta
            // con los errores
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            // Si el validador pasa, almacenamos el usuario
            //Persona::create($request->all());
            $asamblea = new Asamblea();

            $asamblea->nombre = $request->nombre;
            $asamblea->descripcion = $request->descripcion;
            $asamblea->tipo = $request->tipo;
            $asamblea->fecha_hora = $request->fecha_hora;
            $asamblea->save();

            $idAsamblea = $asamblea->id;
            $personas = $request->personas;

            foreach( $personas as $p){
                
                AsambleaPersona::create([
                    'persona_id' => $p,
                    'asamblea_id' => $idAsamblea
                ]);

            }

            return ['created' => true];
        } catch (Exception $e) {
            // Si algo sale mal devolvemos un error.
            return response()->json(['created' => false, 'error mensaje' => $e], 500);
        }
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
        $asamblea = Asamblea::find($id);

        //return $request->all();
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'nombre' => 'required|max:255',
            'descripcion' => 'required|min:10',
            'tipo' => 'required|integer',
            'fecha_hora' => 'required|date_format:Y-m-d H:i:s'
        ];
        try {
            // Ejecutamos el validador y en caso de que falle devolvemos la respuesta
            // con los errores
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'updated' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }

            $asamblea->nombre = $request->nombre;
            $asamblea->descripcion = $request->descripcion;
            $asamblea->tipo = $request->tipo;
            $asamblea->fecha_hora = $request->fecha_hora;
            $asamblea->update();
            return ['updated' => true];
        } catch (Exception $e) {
            // Si algo sale mal devolvemos un error.
            return response()->json(['updated' => false, 'error mensaje' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            if (is_numeric($id)) {
                $asamblea = Asamblea::find($id);
                if (is_null($asamblea)) {
                    return response()->json(['error' => true, 'La asamblea no existe!']);
                } else {
                    $asamblea->delete();
                    return response()->json(['deleted' => true, 'eliminado!']);
                }
            } else {
                return response()->json(['deleted' => false, 'No eliminado!']);
            }
        } catch (Exception $e) {
            return response()->json(['deleted' => false, 'error mensaje' => $e], 500);
        }
    }
}
