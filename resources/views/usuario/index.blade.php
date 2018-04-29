@extends('layouts.dashboard')
@section('content')
    <div class="d-block bg-primary" style="padding-top: 10px;">
        <div class="row ">
            <div class="col-md-6">
                <div class="form-group">
                    {!!Form::select('size', ['fus' => 'Filtrar por Usuario', 'fco' => 'Filtrar por Correo', 'fi' => 'Filtrar por Identificacion'], null, ['class'=>'form-control','placeholder' => 'Filtar por:','id'=>'tipofil','onchange="filtro();"']);!!}
                </div>
            </div>
            <div class="col-md" >
                <div class="form-group" >
                    {!!Form::text('valorfilro',null,['id'=>'valorf', 'class'=>'form-control','placeholder'=>'Ingrese el valor segun el tipo de filtro', 'onkeyup="filtro();"'])!!}
                </div>
            </div>
        </div>
        @include('alert.mensaje')
        <table class="table table-hover table-inverse" id="lista">
            @include('usuario.recargable.listausuarios')
        </table>
        {!!$usuarios->render("pagination::bootstrap-4")!!}
    </div>
    <script>
        var tfiltro="";
        var valorfil="";
        //Filtramos por el campo cedula    
        function filtro()
        {
            if($("#tipofil").val()=="")
                tfiltro="no";
            else
                tfiltro=$("#tipofil").val();

            if($("#valorf").val()=="")
                valorfil="no";
            else
                valorfil=$("#valorf").val();
            var ruta="http://127.0.0.1:8080/filtrousuario/"+tfiltro+'/'+valorfil;
            $.get(ruta, function(res){
                $("#lista").empty();//Elimina la lista actual
                //$(".pagination").remove();
                jQuery("#lista").append(res);//Actualiza la lista
            });
        }
        
    </script>
@stop