<?php

namespace App\Imports;

use App\Models\Persona;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;


class PersonaImport implements ToModel,  WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new Persona([
            'cedula'  => $row['cedula'],
            'nombre' => $row['nombre'],
            'agencia'    => $row['agencia'],
            'celular' => $row['celular'],
            'estado_personas_id'    => $row['estado_personas_id'],
            'correo' => $row['correo'],
            'grupo'    => $row['grupo'],
            'rol_id' => $row['rol_id'],
        ]);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Persona::create([
                'name' => $row[0],
            ]);
        }
    }
}
