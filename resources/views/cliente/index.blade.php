@extends('layouts.dashboard')
@section('content')
<!--Arreglar toda la mierda que hiciste-->
    <div class="d-block bg-primary" style="padding-top: 10px;">
        @include('alert.mensaje')
        <div class="input-group mb-2 ">
            @if($valor=="")
                <input id="cedu" onkeypress="return cedulanica(event,this);" onkeyup="formatonica(this); filtro();" type="text" class="form-control" placeholder="Cedula del cliente" aria-label="Cedula del Cliente" aria-describedby="basic-addon2" >
            @endif
            @if($valor!="")
                <input id="cedu" onkeypress="return cedulanica(event,this);" onkeyup="formatonica(this); filtro();" type="text" class="form-control" placeholder="Cedula del cliente" aria-label="Cedula del Cliente" aria-describedby="basic-addon2" value="{!!$valor!!}">
            @endif
            <div class="input-group-append">
                <button class="btn btn-dark" type="button" id="filtrar">Buscar</button>
            </div>
        </div>
        <table class="table table-hover table-inverse" id="Datos">
            <thead>
                <th class="text-center">Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Sexo</th>
            </thead >
            <tbody id="lista">
                @if($valor=="")
                    @include('cliente.recargable.listaclientes')
                @endif
            </tbody>
        </table>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        {{$clientes->render("pagination::bootstrap-4")}}
    </div>
    <script>
        //Filtramos por el campo cedula    
        function filtro()
        {
            var ruta="https://alquiler.herokuapp.com/filtrocliente/"+$("#cedu").val();
            console.log($("#cedu").val());
            var token=$("#token").val();
            $.get(ruta, function(res){
                $("#lista").empty();//Elimina la lista actual
                //$(".pagination").remove();
                jQuery("#lista").append(res);//Actualiza la lista
            });
        }
        window.onload=function() 
        {
            filtro();
        }
    </script>
@stop
@section("script")
  {!!Html::script("js/jskevin/cedulanica.js")!!} 
@stop