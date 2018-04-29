@extends('layouts.dashboard')
@section('content')
    <div class="d-block bg-primary" style="padding-top: 10px;">
        <div class="input-group mb-2 ">
            <input id="cedu" onkeypress="return cedulanica(event,this);" onkeyup="formatonica(this); filtro(this);" type="text" class="form-control" placeholder="Cedula del cliente" aria-label="Cedula del Cliente" aria-describedby="basic-addon2" value="{!!$valor!!}">
            <div class="input-group-append">
                <button class="btn btn-dark" type="button" id="filtrar">Buscar</button>
            </div>
        </div>
        @include('alert.mensaje')
        <table class="table table-hover table-inverse">
            <thead>
                <th class="text-center">Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th class="text-center">Direccion</th>
                <th>Fecha Nacimiento</th>
            </thead>
            <tbody class="text-center" id="lista"> 
                @if($valor=="")
                    @include('personal.recargable.listapersonal')
                @endif
            </tbody>
        </table>
        {!!$personal->render("pagination::bootstrap-4")!!}
    </div>
    <script>
        //Filtramos por el campo cedula    
        function filtro()
        {
            var ruta="http://127.0.0.1:8080/filtropersonal/"+$("#cedu").val();
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