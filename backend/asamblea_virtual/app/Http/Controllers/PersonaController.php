<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\AsambleaPersona;
use App\Models\Formulario;
use App\Http\Requests\PersonaCreateRequest;
use App\Imports\PersonaImport;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class PersonaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Persona::all());
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
            'cedula' => 'required|min:7',
            'nombre' => 'required|max:255',
            'agencia' => 'required|min:3',
            'celular' => 'required|min:7',
            'correo' => 'required|email',
            'rol_id' => 'required|integer',
            'grupo' => 'required|integer',
            'estado_personas_id' => 'required|integer'
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
            $persona = new Persona();

            $persona->cedula = $request->cedula;
            $persona->nombre = $request->nombre;
            $persona->agencia = $request->agencia;
            $persona->celular = $request->celular;
            $persona->rol_id = $request->rol_id;
            $persona->grupo = $request->grupo;
            $persona->estado_personas_id = $request->estado_personas_id;
            $persona->save();
            return ['created' => true];
        } catch (Exception $e) {
            // Si algo sale mal devolvemos un error.
            return response()->json(['created' => false, 'error mensaje' => $e], 500);
        }
    }

    public function ImportExcelPersonas(Request $request)
    {
        return "200 ok";
    }

    public function import()
    {
        Excel::import(new PersonaImport, 'C:/Users/SIS-06/Desktop/personas.xlsx');

        return "ok 201 subio parce";
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
        $personas = Persona::find($id);

        //return $request->all();
        if (!is_array($request->all())) {
            return ['error' => 'request must be an array'];
        }
        // Creamos las reglas de validación
        $rules = [
            'cedula' => 'required|min:7',
            'nombre' => 'required|max:255',
            'agencia' => 'required|min:3',
            'celular' => 'required|min:7',
            'correo' => 'required|email',
            'rol_id' => 'required|integer',
            'grupo' => 'required|integer',
            'estado_personas_id' => 'required|integer'
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

            $personas->cedula = $request->cedula;
            $personas->nombre = $request->nombre;
            $personas->agencia = $request->agencia;
            $personas->celular = $request->celular;
            $personas->rol_id = $request->rol_id;
            $personas->grupo = $request->grupo;
            $personas->estado_personas_id = $request->estado_personas_id;
            $personas->update();
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
                $personas = Persona::find($id);
                
                if (is_null($personas)) {
                    return response()->json(['error' => true, 'La asamblea no existe!']);
                } else {

                    AsambleaPersona::where('persona_id', '=', $id)->delete();
                    Formulario::where('persona_id', '=', $id)->delete();
                    $personas->delete();
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
