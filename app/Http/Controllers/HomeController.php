<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\Municipio;
use App\Horario;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function home() {
        $horarios = Horario::all();
        return view('home', [
            'horarios' => $horarios
        ]);
    }

    public function listar(Municipio $municipio, $hora) {
        $ruta = Municipio::where('nombre', $municipio->nombre)
                    ->where('hora', 'LIKE', "%$hora%")
                    ->first();
        if (!$ruta)
            return abort(404);
        $lista = Registro::whereDate('created_at', '=', date('Y-m-d'))
                ->where('municipio_id', $ruta->id)
                ->get();
        return view('listar', [
            'lista' => $lista,
            'ruta'  => $ruta
        ]);
    }

    public function registrar(Request $request) {
        $this->validate($request, [
            'cedula' => 'required',
            'nombre' => 'required',
            'horario_id' => 'required|min:10|max:10'
        ], [
            'cedula.required' => 'La cedula es obligatoria.',
            'nombre.required' => 'El nombre es obligatorio.',
            'horario_id.required'   => 'La ruta es obligatoria',
            'horario_id.min' => 'No intentes joderme.. -.-',
            'horario_id.max' => 'Deja quieto -.-'
        ]);
        $separar = explode(" ", $request->input('horario_id'), 2);
        $requestData = $request->all();
        $requestData['horario_id'] = $separar[0];
        $requestData['hora'] = $separar[1];
        $requestData['intentos'] = 1;
        $existe = Registro::where('cedula', $requestData['cedula'])
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->where('horario_id', $requestData['horario_id'])
                    ->first();
        if ($existe) {
            $existe->intentos++;
            $existe->save();
            return redirect('/')->with('flash_message', 'Anotado en la ruta!');    
        }
        Registro::create($requestData);
        return redirect('/')->with('flash_message', 'Anotado en la ruta!');
    }
}
