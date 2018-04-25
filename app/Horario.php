<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
	protected $fillable = ['municipio_id', 'hora', 'check'];

	public $timestamps = false;

    public function municipio() {
    	return $this->belongsTo(Municipio::class);
    }
}
