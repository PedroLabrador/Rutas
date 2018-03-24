<?php

namespace App\Http\Controllers;

use App\Horario;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
    	return view('admin.index');
    }

    public function show() {
        return view('admin.show');
    }

    public function crear(Request $request) {
        $this->validate($request, [
            'hour' => 'required',
        ], [
            'hour.required' => 'La hora es obligatoria.'
        ]);	

    	$data['municipio_id'] = \Auth::user()->municipio->id;
    	$data['hora'] = $request->input('hour');
    	Horario::create($data);
        return redirect('/crear')->with('flash_message', 'Hora creada!');
    }
}
