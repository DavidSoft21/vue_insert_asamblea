<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'personas';
    protected $fillable = [
        'cedula',
        'nombre',
        'agencia',
        'celular',
        'correo',
        'grupo',
        'estado_personas_id',
        'rol_id'
    ];

    public function asambleas()
    {
        return $this->belongsToMany(Asambleas::class);
    }
    
    public function estado()
    {
        return $this->belongsTo(EstadoPersona::class);
    }
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    
}
