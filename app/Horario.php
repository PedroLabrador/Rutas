<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public function municipio() {
    	return $this->belongsTo(Municipio::class);
    }
}
