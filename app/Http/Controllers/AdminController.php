<?php

namespace App\Http\Controllers;

use App\Horario;
use App\Municipio;
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
    	$data['hora'] =  date('h:i A', strtotime($request->input('hour')));
        $data['check'] = true;

    	Horario::create($data);
        return redirect('/crear')->with('flash_message', 'Hora creada!');
    }

    public function mostrar($id) {
        $horario = Horario::where('id', $id)->first();
        $hora = date('H:i', strtotime($horario->hora));
        return view('admin.edit', ['hora' => $hora, 'id' => $horario->id, 'check' => $horario->check]);
    }

    public function editar(Request $request) {
        $id = $request->input('id');
        $data['hora'] = date('h:i A', strtotime($request->input('hour')));
        $data['check'] = ($request->input('check') == 'on') ? true : false;

        $horario = Horario::where('id', $id);
        $horario->update($data);
        return redirect('/admin')->with('flash_message', 'Hora editada!');
    }

    public function anotar(Municipio $municipio) {
        $horarios = Horario::where('municipio_id', $municipio->id)->
                             where('check', true)->
                             get();
        return view('admin.anotar', [
            'horarios' => $horarios
        ]);
    }
}
