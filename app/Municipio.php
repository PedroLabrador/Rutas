<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    public $timestamps  = false;
    protected $fillable = ['nombre'];

    public function getRouteKeyName() {
        return 'nombre';
    }

    public function horarios() {
    	return $this->hasMany(Horario::class);
    }
}
