<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Persona;

class PersonaCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'personas.cedula' => 'required|min:7',
            'personas.nombre' => 'required|min:3',
            'personas.agencia' => 'required|min:4',
            'personas.celular' => 'required|min:7',
            'personas.correo' => 'required|email',
            'personas.rol_id' => 'required|min:1',
            'personas.grupo' => 'required|min:1',
            'personas.estado_personas_id' => 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'cedula.required' => 'Añade un cedula',
            'nombre.required' => 'Añade un nombre',
            'agencia.required' => 'Añade un grupo',
            'celular.required' => 'Añade un celular',
            'correo.required' => 'Añade un correo',
            'rol_id.required' => 'Añade un rol id',
            'grupo.required' => 'Añade un grupo',
            'estado_personas_id.required' => 'Añade un estado personas id'
        ];
    }

    public function crearPersona()
    {

        $datos = $this->validated();
        $persona = Persona::create([
            'cedula' => $datos['personas']['cedula'],
            'nombre' => $datos['personas']['nombre'],
            'agencia' => $datos['personas']['agencia'],
            'celular' => $datos['personas']['celular'],
            'correo' => $datos['personas']['correo'],
            'rol_id' => $datos['personas']['rol_id'],
            'grupo' => $datos['personas']['grupo'],
            'estado_personas_id' => $datos['personas']['estado_personas_id']
        ]);

        return $persona;
    }
}
