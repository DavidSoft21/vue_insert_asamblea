<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioPregunta extends Model
{
    use HasFactory;
    protected $table = 'formulario_preguntas';
    protected $fillable = [
        'formulario_detalle_id', 
        'temario_id', 
    ];
}
