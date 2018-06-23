@extends('layouts.dashboard')
@section('content')
  <div class="card" >
    <h4 class="card-header">Agregar Usuario</h4>
    <div class="card-body">
      @include('alert.errores')
      @include('alert.mensaje')

      <form action="{{route('usuario.store')}}" method="POST" >

        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row ">
          <div class="col-md-3 "></div>
          <div class="col-md-6 ">
            <div class="form-group text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                {!!Form::label('Correo:')!!}
                {!!Form::text('correo',null,['id'=>'Correo','class'=>'form-control','placeholder'=>'ejemplo@hotmail.com','onkeyup'=>'existe("2");','autocomplete'=>'off'])!!}
                <spam id="msjemail" style="color:red;"></spam> 
            </div>
          </div>
        </div>
        @include('usuario.formulario.datos')
            <div class="text-center">
        <button class="btn btn-primary" type="submit" id="agregar" disabled="disabled">Agregar</button>
        </div >
      </form>
    </div>
  </div>
  <script>
    var correcto=true;
    function coinciden()
    {
        var contra1=$("#contraseña").val();
        var contra2=$("#confcontraseña").val();
        /*si estan vacios los campos*/
        if(contra1.length==0)
        {
          $("#msjpass").empty();
          $("#agregar").attr("disabled", true);
          correcto=true;/*enrealidad no esta correcto, es para no crear conflicto*/
          return;
        }
        /*validar que sean iguales*/
        if(contra1!=contra2)
        {
            if(correcto==true)/*condicion con el fin de evitar sobre escribir cada momento en #msjpass*/
            {
              jQuery("#msjpass").append("No coinciden las contraseñas!");
              correcto=false;
              $("#agregar").attr("disabled", true);
              return;
            }
        }
        else
        {
          $("#msjpass").empty();
          /*Validar longitud*/
          if(contra1.length < 6)
          {
            jQuery("#msjpass").append("La longitud de la contraseña debe ser mayor a 5");
            correcto=false;
            $("#agregar").attr("disabled", true);
            return;
          }
          else
          {
            correcto=true;
            $("#agregar").attr("disabled", false);
          }
        }
    }
    function existe(decision)
    {
      /*validacion para el usuario*/
      if(decision==1)
      {
        var ruta="https://alquiler.herokuapp.com/userexist/"+$("#usuario").val()+"/"+decision;
        if($("#usuario").val()!="")
        {
          $.get(ruta, function(res){
              if(res.length>0)
                jQuery("#msjuser").append("Este usuario ya existe!");
              else
                $("#msjuser").empty();
          });
        }
      }

      /*validacion para el correo*/
      if(decision==2)
      {
        var ruta="https://alquiler.herokuapp.com/userexist/"+$("#Correo").val()+"/"+decision;
        if($("#correo").val()!="")
        {
          $.get(ruta, function(res){
              if(res.length>0)
                jQuery("#msjemail").append("Este email ya existe!");
              else
                $("#msjemail").empty();
          });
        }
      }

    }
  </script>
@stop