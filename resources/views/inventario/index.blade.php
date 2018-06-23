@extends('layouts.dashboard')
@section('content')
    <div class="d-block bg-primary" style="padding-top: 10px;">
        <div class="row ">
            <div class="col-md-4">
                <div class="form-group">
                    <select onchange="filtro(this,0);" class="form-control" id="servicios">
                        <option></option>
                        @foreach($servicios as $servicio)
                        <option >{!!$servicio->Nombre!!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md" >
                <div class="form-group" >
                    {!!Form::text('NombreArti',null,['id'=>'nombreA', 'class'=>'form-control','placeholder'=>'Nombre del articulo', 'onkeyup="filtro(0,this);"'])!!}
                </div>
            </div>
        </div>

        <table class="table table-hover table-inverse">
            <thead >
                <th class="text-center">Servicio</th>
                <th class="text-center">Nombre</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th>Costo_Alquiler</th>
                <th>Costo_Objeto</th>
                <th>Disponibilidad</th>
            </thead>
            <tbody class="text-center" id="lista"> 
                @include('inventario.recargable.listainventario')
            </tbody>
        </table>
        
        <input type="hidden"  value="0" id="comodin">
        {{$inventario->render("pagination::bootstrap-4")}}
    </div>

    <script>
        var servi=0;
        var item=0;
        //Filtramos por el campo cedula    
        function filtro(val1=0,val2=0)
        {
            if($("#servicios").val()=="")
                servi=0;
            else
                servi=$("#servicios").val();

            if($("#nombreA").val()=="")
                item=0;
            else
                item=$("#nombreA").val();
            console.log(servi+"--"+item);
            var ruta="https://alquiler.herokuapp.com/filtroinventario/"+servi+'/'+item;
            console.log(ruta);
            var token=$("#token").val();
            $.get(ruta, function(res){
                $("#lista").empty();//Elimina la lista actual
                //$(".pagination").remove();
                jQuery("#lista").append(res);//Actualiza la lista
            });
        }
        
    </script>
@stop