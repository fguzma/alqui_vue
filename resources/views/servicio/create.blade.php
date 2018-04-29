@extends('layouts.dashboard')
@section('content')
<div class="card">
  <h4 class="card-header">Agregar Servicio</h4>
  <div class="card-body">
    @include('alert.mensaje')
    <form action="{{route('servicio.store')}}" method="POST" >

    <input type="hidden" name="_method" value="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
         @include('servicio.formulario.datos')
         <input class="btn btn-primary" type="submit" value="Agregar">
        </form>
  </div>
</div>     
@stop