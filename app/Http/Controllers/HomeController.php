<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use App\Municipio;

class HomeController extends Controller
{
    public function home() {
        $municipios = Municipio::all();
        return view('home', [
            'municipios' => $municipios
        ]);
    }

    public function listar(Municipio $municipio) {
        $lista = Registro::whereDate('created_at', '=', date('Y-m-d'))
                ->where('municipio_id', $municipio->id)
                ->get();

        return view('listar', [
            'lista' => $lista
        ]);
    }

    public function registrar(Request $request) {
        $this->validate($request, [
            'cedula' => 'required',
            'nombre' => 'required',
            'municipio_id' => 'required'
        ], [
            'cedula.required' => 'La cedula es obligatoria.',
            'nombre.required' => 'El nombre es obligatorio.',
            'municipio_id.required'   => 'La ruta es obligatoria'
        ]);
        $requestData = $request->all();

        Registro::create($requestData);

        return redirect('/')->with('flash_message', 'Anotado en la ruta!');
    }
}
