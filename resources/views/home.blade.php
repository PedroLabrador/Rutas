@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Municipios</div>

                <div class="panel-body">

                    @forelse ($municipios as $municipio)
                        <div class="row text-center">
                            <a class="btn btn-default" href="/municipio/{{ $municipio->nombre }}">{{ $municipio->nombre }}</a>
                        </div>
                    @empty
                    @endforelse

			    </div>
            </div>
        </div>
    </div>
</div>
@endsection
