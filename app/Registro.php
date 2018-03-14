<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = ['cedula', 'nombre', 'hora', 'municipio_id'];
}
