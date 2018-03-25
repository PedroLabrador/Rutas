@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Panel de Administración</div>

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
								{{ session()->get('flash_message') }}
							</div>
						</div>
					@endif

                    <form class='form' method='post'>
                		{{ csrf_field() }}
                		<div class='text-center'><label for='hour'>Hora</label></div>
                		
                		<div class="col-md-4 col-md-offset-4 p-t">
							<input type='time' class='form-control' name='hour' id='hour' value='{{$hora}}' required>
                		</div>
                		<div class="col-md-4 col-md-offset-4 p-t text-center">
                			<button class='btn btn-default'>Modificar</button>
                		</div>
                		<input type='hidden' value='{{$id}}' name='id'>
                    </form>
			    </div>
            </div>
            <div><a href="{{ route('admin') }}" class='btn btn-default'>Regresar</a></div>
        </div>
    </div>
</div>
@endsection