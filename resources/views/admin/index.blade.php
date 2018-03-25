@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Panel de Administración</div>

                <div class="panel-body">
                    @if (session()->has('delete'))
                        <div class="m-t-2">
                            <div class="alert alert-success">
                                {{ session()->get('delete') }}
                            </div>
                        </div>
                    @endif
                    <span class='float-right'><strong>{{ Auth::user()->municipio->nombre }}</strong></span>
                    <h5>Bienvenido/a {{ Auth::user()->name }}</h5>
                    <hr>
                    <div class="table-responsive">          
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Hora</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            @forelse (Auth::user()->municipio->horarios as $actual)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $actual->hora }}</td>
                                <td><a class='btn btn-warning' href="/lista/{{Auth::user()->municipio->nombre}}/{{$actual->hora}}">Lista</a></td>
                                <td><a class='btn btn-primary' href="/editar/{{$actual->id}}">Editar</a></td>
                                <td><a class='btn btn-danger'  href="/borrar/{{$actual->id}}">Borrar</a></td>
                            </tr>        
                            @empty
                                No hay rutas agregadas.
                            @endforelse
                    </table>
                    </div>
                    
                	<a class="btn btn-default" href='/crear'>Crear nueva hora de salida</a>
			    </div>
            </div>
        </div>
    </div>
</div>
@endsection