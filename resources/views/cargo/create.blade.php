@extends('layouts.dashboard')
@section('content')
<div class="card">
  <h4 class="card-header">Agregar Cargo</h4>
  <div class="card-body">
    @include('alert.mensaje')
    <form action="{{route('servicio.store')}}" method="POST" >

        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
        <div class="row ">
            <div class="col-md-6">
                <div class="form-group">
                    {!!Form::label('Nombre del Cargo:')!!}
                    {!!Form::text('Nombre',null,['class'=>'form-control','placeholder'=>'ej: Conductor'])!!}
                </div>
            </div>
        </div>
        <input class="btn btn-primary" type="submit" value="Agregar">
    </form>
  </div>
</div>   
<div class="card">
  <h4 class="card-header">Asignar cargo a personal</h4>
  <div class="card-body">
    @include('alert.mensaje')

        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
        <div class="row ">
            <div class="col-md-6">
            <div class="form-group">
                <!--Aqui va el codigo-->
            </div>
        </div>
        <a class="btn btn-primary" href="#tablaB" onclick="add()">Agregar</a>
  </div>
</div>  
<!--TABLA A-->
<div class="row table-inverse" > 
  <div class="col-md-4 ">
    <div class="list-group " id="list-tab" role="tablist" style="height:30em; overflow:scroll;">
      <table class="table table-hover table-inverse"  >
        <thead>
          <tr>
            <th class="text-center">Cargo</th>
          </tr>
        </thead>
        <tbody>
          @foreach($Cargos as $cargo)
            <tr>
              <td >{!!$cargo->Nombre_Cargo!!}</td>
              <td class="btn-primary text-center">
                <input type="checkbox" OnClick='addcargo(this,"{!!$cargo->Nombre_Cargo!!}","{!!$cargo->ID_Cargo!!}")'>
              </td>
            </tr>  
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-8" style="height:30em; overflow:scroll;padding-left: 0px; ">
    <div class="tab-content" id="nav-tabContent">
        <div  data-spy="scroll" class="tab-pane fade show active" role="tabpanel" >
          <table class="table table-hover table-inverse"  >
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
              </tr>
            </thead>
            <tbody>
              @foreach($personal as $persona)
                  <tr>
                    <td >{!!$persona->Nombre!!}</td>
                    <td >{!!$persona->Apellido!!}</td>
                    <td >{!!$persona->Cedula_Personal!!}</td>
                    <td class="btn-primary text-center">
                      <input type="checkbox" OnClick='addpersonal(this,"{!!$persona->Nombre!!}","{!!$persona->Apellido!!}","{!!$persona->Cedula_Personal!!}");'>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
<!--TABLA B-->
<div style="display : none; " id="tablaB"> 
  <div class="col-md-12" style=" overflow:scroll;padding-left: 0px; ">
    <div class="tab-content" id="nav-tabContent">
        <div  data-spy="scroll" class="tab-pane fade show active" role="tabpanel" >
          <table class="table table-hover table-inverse"  >
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cedula</th>
                <th>Cargo</th>
              </tr>
            </thead>
            <tbody id="tb">
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
@stop
@section("script")
  <script>
    var listapersonal=new Object();
    var listacargo=new Object();
    //agregamos o eliminamos en la lista personal
    function addpersonal(elemento,nombre,apellido,cedula)
    {
      if(elemento.checked==true)
      {
        listapersonal[cedula]=[nombre,apellido,cedula];
      }
      else
      {
        delete listapersonal[cedula];
      }
    }
    //agregamos o eliminamos en la lista cargo
    function addcargo(elemento,cargo,key)
    {
      if(elemento.checked==true)
      {
        listacargo[key]=[cargo,key];
      }
      else
      {
        delete listacargo[key];
      }
    }
    function add()
    {
      $("#tablaB").show();
    }
  /*var ListaPersonal = new Object();
  var cedula=["001-010997-0012p","kevin","valverde"];
  var cedula2=["001-010997-0013p","asd","asd"];
    $(document).ready(function(){
      ListaPersonal[cedula[0]]=cedula;
      ListaPersonal[cedula2[0]]=cedula2;
      delete ListaPersonal["001-010997-0012p"];
      console.log(ListaPersonal[cedula2[0]][1]);
    });*/
  </script>
@stop