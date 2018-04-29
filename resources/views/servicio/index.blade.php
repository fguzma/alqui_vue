@extends('layouts.dashboard')
@section('content')
    <div class="d-block bg-primary" style="padding-top: 10px;">
        <div class="input-group mb-2 ">
            <input onkeyup="filtro(this);" type="text" class="form-control" placeholder="Nombre del servicio" aria-label="Nombre del servicio" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-dark" type="button" id="filtrar">Buscar</button>
            </div>
        </div>
        @include('alert.mensaje')
        <table class="table table-hover table-inverse">
            <thead>
                <th class="text-center">Nombre</th>
            </thead>
            <tbody id="lista"> 
                @include('servicio.recargable.listaservicios')
            </tbody>
        </table>
        {!!$servicios->render("pagination::bootstrap-4")!!}
    </div>
    <script>
        //Filtramos por el campo cedula    
        function filtro(val)
        {
            var ruta="http://127.0.0.1:8080/filtroservicio/"+val.value;
            var token=$("#token").val();
            $.get(ruta, function(res){
                $("#lista").empty();//Elimina la lista actual
                //$(".pagination").remove();
                jQuery("#lista").append(res);//Actualiza la lista
            });
        }
    </script>
@stop