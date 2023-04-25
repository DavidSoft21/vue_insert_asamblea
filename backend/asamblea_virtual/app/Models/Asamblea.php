<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asamblea extends Model
{
    use HasFactory;
    protected $table = 'asambleas';
    protected $fillable = [
        'nombre', 
        'descripcion', 
        'tipo', 
        'fecha_hora'
    ];

    public function personas()
    {
        return $this->belongsToMany(Personas::class);
    }

}
