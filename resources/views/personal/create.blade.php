@extends('layouts.dashboard')
@section('content')
  <div class="card">
    <h4 class="card-header">Agregar Personal</h4>
    <div class="card-body">
      @include('alert.errores')
      @include('alert.mensaje')
      <form action="{{route('personal.store')}}" method="POST" >

        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row ">
          <div class="col-md-3 "></div>
          <div class="col-md-6 ">
            <div class="form-group text-center">
                {!!Form::label('Cedula','Cedula:')!!}
                {!!Form::text('Cedula_Personal',null,['class'=>'form-control','placeholder'=>'xxx-xxxxxx-xxxxx', 'onkeypress="return cedulanica(event,this);"','onkeyup="formatonica(this); buscar(this);"'])!!}
          </div>
          </div>
        </div>
        @include('personal.formulario.datos')
        <div class="text-center">
          <input class="btn btn-primary"  type="submit" id="Agregar">
        </div >
      </form>
    </div>
  </div>   
  <script>
  var autocompletado=false;
  function buscar(cedula)
  {
    var ruta="https://alquiler.herokuapp.com/personal/"+cedula.value;
    var token=$("#token").val();
    autocompletado=false;
      $.ajax({
          url: ruta,
          headers:{'X-CSRF-TOKEN': token},
          type: 'GET',
          dataType: 'json',
          success: function(){
              autocompletado=true;
              alert("El Personal ya esta registrado, no sera posible agregarlo");
              $("#Agregar").prop('disabled',true);
              autocompletar(cedula.value);
          }
      });
      if(autocompletado==false)
      {
        $("#Nombre").val("");
        $("#Apellido").val("");
        $("#Direccion").val("");
        $("#Fecha_Nac").val("");
        $("#Agregar").prop('disabled',false);
      }
  }
  function autocompletar(cedula)
  {
    var ruta="https://alquiler.herokuapp.com/personal/"+cedula;
    $.get(ruta, function(res){
          $("#Nombre").val(res.Nombre);
          $("#Apellido").val(res.Apellido);
          $("#Direccion").val(res.Direccion);
          $("#Fecha_Nac").val(res.Fecha_Nac);
      });
  }
  </script>  
@stop
<!--Ese escript no siempre se utiliza por lo que hacemos uso de la seccion script-->
@section("script")
  {!!Html::script("js/jskevin/cedulanica.js")!!} 
@stop