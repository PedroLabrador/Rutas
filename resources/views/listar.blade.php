@extends('layouts.app')


@section('content')
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
                {{ session()->get('flash_message') }}
            </div>
        </div>
    @endif
    <h2>Lista {{ Request::route()->municipio->nombre . " " . $ruta->hora }}</h2>

    <div class="m-t-2">
        <div class="container">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>

                @forelse ($lista as $usuario)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $usuario->cedula }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td><span class='badge-default'>{{ $usuario->intentos }}</span></td>
                </tr>
                @empty
                    No hay usuarios anotados en la lista para hoy
                @endforelse
            </table>
        </div>
    </div>

    @guest
        <a href="{{ route('home') }}" class='btn btn-default'>Atras</a>
    @else
        <a href="{{ route('admin') }}" class='btn btn-default'>Atras</a>
    @endguest
</div>
@endsection
