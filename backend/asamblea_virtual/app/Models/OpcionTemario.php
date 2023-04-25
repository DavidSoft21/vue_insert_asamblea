<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionTemario extends Model
{
    use HasFactory;
    protected $table = 'opcion_temario';
    protected $fillable = [
        'opcion_id',
        'temario_id'
    ];
}
