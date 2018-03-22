<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\Municipio;

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
        $municipios = Municipio::all();
        return view('home', [
            'municipios' => $municipios
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
            'municipio_id' => 'required|min:10|max:10'
        ], [
            'cedula.required' => 'La cedula es obligatoria.',
            'nombre.required' => 'El nombre es obligatorio.',
            'municipio_id.required'   => 'La ruta es obligatoria',
            'municipio_id.min' => 'No intentes joderme.. -.-',
            'municipio_id.max' => 'Deja quieto -.-'
        ]);
        $separar = explode(" ", $request->input('municipio_id'), 2);
        $requestData = $request->all();
        $requestData['municipio_id'] = $separar[0];
        $requestData['hora'] = $separar[1];
        $requestData['intentos'] = 1;
        $existe = Registro::where('cedula', $requestData['cedula'])
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->where('municipio_id', $requestData['municipio_id'])
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
