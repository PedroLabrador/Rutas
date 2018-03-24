<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Municipio;
use App\Rules\Special;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'town' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'special' => new Special()
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no debe exceder los 255 caracteres.',
            'email.required' => 'El correo es requerido.',
            'email.email' => 'El correo tiene un tipo incorrecto.',
            'email.max' => 'El correo no debe exceder los 255 caracteres.',
            'email.unique' => 'El correo ya está registrado.',
            'town.required' => 'El municipio es requerido.',
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña debe contener minimo 6 caracteres.',
            'password.confirmed' => 'Las contraseñas no coindicen.'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $town = $data['town'];
        $municipio = Municipio::where('nombre', 'LIKE', "%$town%")->first();
        if (!$municipio) {
            Municipio::create([
                'nombre' => $town
            ]);
            $municipio = Municipio::where('nombre', 'LIKE', "%$town%")->first();
        }
        return User::create([
            'municipio_id' => $municipio->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
