<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioDetalle extends Model
{
    use HasFactory;
    protected $table = 'formulario_detalle';
    protected $fillable = [
        'id', 
        'nombre_formulario', 
        'fecha', 
    ];
}
