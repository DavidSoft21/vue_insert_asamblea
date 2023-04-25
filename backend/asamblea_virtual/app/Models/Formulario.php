<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;
    protected $table = 'formularios';
    protected $fillable = [
        'persona_id',
        'temario_id',
        'opciones_id',
        'formulario_detalle_id',
        'respuesta_libr'
    ];
    
    public function opciones(){
        return $this->hasMany(Opcion::class);
    }
    public function temario()
    {
        return $this->belongsTo(Temario::class);
    }
}
