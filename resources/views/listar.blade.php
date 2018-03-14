<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rutas</title>

        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            .content {
                width: 40%;
                margin: 0 auto;
                text-align: center
            }
            .btn, .form-control {
                margin: 1em 
            }   
            .m-t-2 {
                margin-top: 5%
            }
        </style>
    </head>
    <body>
        <div class="container">

            @if ($errors->any())
                <div class="content m-t-2">
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('flash_message'))
                <div class="content m-t-2">
                    <div class="alert alert-success">
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                        {{ session()->get('flash_message') }}
                    </div>
                </div>
            @endif
            <h2>Lista {{ Request::route()->municipio->nombre . " " . Request::route()->municipio->hora }}</h2>
            
            <div class="m-t-2">
                <table class="table">
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                    
                    @forelse ($lista as $usuario)
                    <tr>
                        <td>
                            {{ $usuario->cedula }}                       
                        </td>
                        <td>
                            {{ $usuario->nombre }}
                        </td>
                        <td></td>
                    </tr>
                    @empty
                        No hay usuarios anotados en la lista para hoy
                    @endforelse
                </table>
            </div>
        </div>
    </body>
</html>
