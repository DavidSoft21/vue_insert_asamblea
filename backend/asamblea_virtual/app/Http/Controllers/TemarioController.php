<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Temario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OpcionTemario;


class TemarioController extends Controller
{
    public function index()
    {
        return response()->json(Temario::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //return $request->all();
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'nombre' => 'required|max:255',
            'posicion' => 'required|integer',
            'estado_temario_id' => 'required|integer',
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
            $temario = new Temario();

            $temario->nombre = $request->nombre;
            $temario->posicion = $request->posicion;
            $temario->estado_temario_id = $request->estado_temario_id;
            $temario->save();


            $idTemario = $temario->id;
            $opciones = $request->opciones;

            foreach( $opciones as $p){
                
                OpcionTemario::create([
                    'temario_id' => $idTemario,
                    'opcion_id' => $p
                ]);

            }

            return ['created' => true];
        } catch (Exception $e) {
            // Si algo sale mal devolvemos un error.
            return response()->json(['created' => false, 'error mensaje' => $e], 500);
        }
    }

    public function show_temerio_nombre(Request $request)
    {
    
        $temario = Temario::where('nombre','LIKE',"%{$request->nombre}%")->get();

        return  $temario[0]->id;
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
        $temario = Temario::find($id);

        //return $request->all();
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'nombre' => 'required|max:255',
            'posicion' => 'required|integer',
            'estado_temario_id' => 'required|integer',
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

            $temario->nombre = $request->nombre;
            $temario->posicion = $request->posicion;
            $temario->estado_temario_id = $request->estado_temario_id;
            $temario->update();
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
                $temario = Temario::find($id);
                if (is_null($temario)) {
                    return response()->json(['error' => true, 'La temario no existe!']);
                } else {
                    $temario->delete();
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
