<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temario extends Model
{
    use HasFactory;
    protected $table = 'temarios';
    protected $fillable = [
        'nombre',
        'posicion',
        'estado_temario_id '
    ];

    public function opciones()
    {
        return $this->belongsToMany(Opcion::class);
    }
    public function formularios()
    {
        return $this->hasMany(Formulario::class);
    }
    
}
