<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';
    protected $fillable = ['cedula', 'nombre', 'hora', 'horario_id', 'intentos'];
}
