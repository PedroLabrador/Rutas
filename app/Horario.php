<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public function municipio() {
    	return $this->hasOne(Municipio::class, 'id');
    }
}
