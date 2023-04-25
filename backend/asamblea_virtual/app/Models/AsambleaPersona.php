<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsambleaPersona extends Model
{
    use HasFactory;
    protected $table = 'asamblea_persona';
    protected $fillable = [
        'asamblea_id',
        'persona_id'
    ];
}
