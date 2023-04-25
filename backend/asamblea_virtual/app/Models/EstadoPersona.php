<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPersona extends Model
{
    use HasFactory;
    protected $table = 'estado_personas';
    protected $fillable = [
        'nombre'
    ];

    public function persona(){
        $this->hasOne(Persona::class);
    }
}
