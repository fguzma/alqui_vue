@extends('layouts.dashboard')
@section('content')
  <div class="card">
    <h4 class="card-header">Agregar Inventario</h4>
    <div class="card-body">
      <div id="mensaje">
        @include('alert.mensaje')
      </div>
      <form action="{{route('inventario.store')}}" method="POST" id="data">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('inventario.formulario.datos')
        <input class="btn btn-primary" type="submit">
        <input class="btn btn-primary" type="button" value="Crear con js" onclick="agregar();">
      </form>
    </div>
  </div>     
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
  <script>
  //Agrega el item mediante una consulta AJAX
  /*RECARGAR LOS MSJ DE ERROR*/
  function agregar()
  {
    var valor = $("#data").val();//{Cedula_Cliente:"999-999999-99999",Nombre:"Kavv",Apellido:"Kavv",Edad:45,Sexo:"Hombre"};
    var ruta = "http://127.0.0.1:8080/inventario";
    var token = $("#token").val();
    console.log($("#data").serialize());
    $.ajax({
      url: ruta,
      headers: {'X-CSRF-TOKEN': token},
      type: 'POST',
      dataType: 'json',
      data:$("#data").serialize(),
      success: function(){
        console.log("agregado");
        recargar('msj');
        return 0;
        console.log('siguio');
      }
    }).fail( function( jqXHR, textStatus, errorThrown ) {
      var x=jqXHR.responseJSON;
      var html='<div class="alert alert-warning alert-dismissible" role="alert">'+
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
      '<ul>';
      
      $.each(jqXHR.responseJSON,function(indice,valor){
            html+='<li>'+valor+'</li>';
      });
      html+='</ul>'+
      '</div>';
      console.log(html);
      $("#mensaje").empty();//Elimina la lista actual
      jQuery("#mensaje").append(html);//Actualiza la lista
    });
  }
  function recargar(val)
  {
    var ruta="http://127.0.0.1:8080/mensaje/"+val;
    $.get(ruta, function(res){
      $("#mensaje").empty();//Elimina la lista actual
      jQuery("#mensaje").append(res);//Actualiza la lista
    });
    if(val=="msj")
    {
      $("#servicios").val("");
      $("#nombre").val("");
      $("#cantidad").val("");
      $("#CA").val("");
      $("#CO").val("");
    }
  }
  </script>
@stop