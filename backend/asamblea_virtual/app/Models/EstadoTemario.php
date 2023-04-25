<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoTemario extends Model
{
    use HasFactory;
    protected $table = 'estado_temarios';
    protected $fillable = [
        'nombre'
    ];
    public function estadoTemario()
    {
        return $this->belongsTo(Temario::class);
    }
}
