@extends('layouts.dashboard')
@section('content')
  <div class="card">
    <h4 class="card-header">Agregar Cliente</h4>
    <div class="card-body">
      @include('alert.errores')
      <div class="alert alert-info alert-dismissible" role="alert" style="display:none" id="msj">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
          <li>Cliente agregado exitosamente</li>
        </ul>
      </div>
      <form action="{{route('cliente.store')}}" method="POST" id="data">

        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row ">
          <div class="col-md-3 "></div>
          <div class="col-md-6 ">
            <div class="form-group text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                {!!Form::label('Cedula','Cedula:')!!}
                {!!Form::text('Cedula_Cliente',null,['class'=>'form-control','placeholder'=>'xxx-xxxxxx-xxxxx',  'onkeypress="return cedulanica(event,this);"','onkeyup="formatonica(this); buscar(this);"','id="CC"'])!!}    
            </div>
          </div>
        </div>
        @include('cliente.formulario.datos')
        <!---->
        <div class="text-center">
          <input class="btn btn-primary"  type="submit" id="Agregar">
        </div >
        <!--<input class="btn btn-primary" type="button" value="Crear con js" onclick="agregar();">-->
      </form>
    </div>
  </div>
  <script>
  var autocompletado=false;
  function buscar(cedula)
  {
    var ruta="http://127.0.0.1:8080/cliente/"+cedula.value;
    var token=$("#token").val();
    autocompletado=false;
      $.ajax({
          url: ruta,
          headers:{'X-CSRF-TOKEN': token},
          type: 'GET',
          dataType: 'json',
          success: function(){
              autocompletado=true;
              alert("El cliente ya esta registrado, no sera posible agregarlo");
              $("#Agregar").prop('disabled', true);
              autocompletar(cedula.value);
          }
      });
      if(autocompletado==false)
      {
        $("#Nombre").val("");
        $("#Apellido").val("");
        $("#Sexo").val("");
        $("#Edad").val("");
        $("#Agregar").prop('disabled',false);
      }
  }
  
  function autocompletar(cedula)
  {
    var ruta="http://127.0.0.1:8080/cliente/"+cedula;
    $.get(ruta, function(res){
          $("#Nombre").val(res.Nombre);
          $("#Apellido").val(res.Apellido);
          $("#Edad").val(res.Edad);
          if(res.Sexo=="Masculino")
            $("#Sexo").val("M");
          else
            $("#Sexo").val("F");
      });
      
  }
  //Agrega al cliente mediante una consulta AJAX
  function agregar()
  {
    var valor = $("#data").val();//{Cedula_Cliente:"999-999999-99999",Nombre:"Kavv",Apellido:"Kavv",Edad:45,Sexo:"Hombre"};
    var ruta = "http://127.0.0.1:8080/cliente";
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
        $("#msj").fadeIn();//hace aparecer el msj
      }
    });
  }
  </script>
@stop

@section("script")
  {!!Html::script("js/jskevin/cedulanica.js")!!} 
@stop