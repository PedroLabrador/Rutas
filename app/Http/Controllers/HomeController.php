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
        $municipios = Municipio::all();
        return view('home', [
            'municipios' => $municipios
        ]);
    }

    public function general(Municipio $municipio) {
        $horarios = Horario::where('municipio_id', $municipio->id)->
                             where('check', true)->
                             get();
        $disponible = array();
        $it = 0;
        $cant = 1;
        foreach ($horarios as $salida) {
            $timeFirst  = strtotime($salida->hora) - ($cant * 60 * 60);
            $timeSecond = time();
            $diff = $timeSecond - $timeFirst;
            $disponible[$it++] = ($diff > 0 && $diff < 4500 ) ? true : false;
        }
        return view('general', [
            'horarios' => $horarios,
            'disponible' => $disponible
        ]);
    }

    public function listar(Municipio $municipio, $hora) {
        $ruta = Horario::where('municipio_id', $municipio->id)
                    ->where('hora', 'LIKE', "%$hora%")
                    ->first();
        if (!$ruta)
            return abort(404);
        $lista = Registro::whereDate('created_at', '=', date('Y-m-d'))
                ->where('horario_id', $ruta->id)
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

        $horario = Horario::where('id', $requestData['horario_id'])->first();

        $existe = Registro::where('cedula', $requestData['cedula'])
                    ->whereDate('created_at', '=', date('Y-m-d'))
                    ->where('horario_id', $requestData['horario_id'])
                    ->first();

        $municipio = $horario->municipio->nombre;
        $hora = $requestData['hora'];

        if ($existe) {
            $existe->intentos++;
            $existe->save();
            return redirect("/lista/$municipio/$hora");
        }
        Registro::create($requestData);

        if (\Auth::user())
            return redirect("/anotar/$municipio")->with('flash_message', 'Anotado en la ruta!');

        return redirect("/lista/$municipio/$hora");
    }
}
