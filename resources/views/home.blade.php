@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

					@if ($errors->any())
						<div class="m-t-2">
							<ul class="alert alert-danger">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if (session()->has('flash_message'))
						<div class="m-t-2">
							<div class="alert alert-success">
								<!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
								{{ session()->get('flash_message') }}
							</div>
						</div>
					@endif

					<div class="content m-t-2">
						<div>
							<form class='form' action="/registrar" method="post">
								{{ csrf_field() }}
								<select name="horario_id" id="" class='form-control space'>
									@forelse ($horarios as $horario)
										<option value="{{ $horario->id }} {{ $horario->hora }}">{{ $horario->municipio->nombre }} Hora: {{ $horario->hora }}</option>
									@empty
										<option value="0" selected disabled>No hay rutas</option>                       
									@endforelse
								</select>
								<label for="cedula">Cedula</label>
								<input class='form-control space' type="text" name="cedula" id="cedula">
								<label for="nombre">Nombre</label>
								<input class='form-control space' type="text" name="nombre" id="nombre">
								<button class='btn btn-default space'>Anotarse</button>
							</form>
						</div>
					</div>

			    </div>
            </div>
        </div>
    </div>
</div>
@endsection