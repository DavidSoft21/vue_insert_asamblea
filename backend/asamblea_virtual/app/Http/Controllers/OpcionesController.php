<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Opcion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpcionesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Opcion::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //return $request->all();
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'nombre' => 'required|max:255'
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
            //Opcion::create($request->all());
                $persona = new Opcion();

                $persona->nombre = $request->nombre;
            
                $persona->save();
            return ['created' => true];
        } catch (Exception $e) {
            // Si algo sale mal devolvemos un error.
            return response()->json(['created' => false, 'error mensaje' => $e], 500);
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $opcion = Opcion::find($id);

        //return $request->all();
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'nombre' => 'required|max:255'
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

            $opcion->nombre = $request->nombre;
    
            $opcion->update();
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
                $opcion = Opcion::find($id);
                if (is_null($opcion)) {
                    return response()->json(['error' => true, 'La asamblea no existe!']);
                } else {
                    $opcion->delete();
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
