@extends('layouts.dashboard')
@section('content')
  <!--Referencias para el calendario-->
  {!!Html::script("https://code.jquery.com/jquery-3.2.1.min.js")!!}
  {!!Html::script("js/js/gijgo/gijgo.js")!!}
  {!!Html::style("http://code.gijgo.com/1.5.1/css/gijgo.css")!!}
  <form action="{{route('reservacion.store')}}" method="POST" id='formulario' target="_blank" >
    <input type="hidden" name="_method" value="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="false">
      <div class="carousel-inner">
        <div id="parte1" class="carousel-item active">
          <div class="card">
            <h4 class="card-header">Reservar</h4>
            <div class="card-body">
              @include('alert.errores')
              @include('alert.mensaje')
              <div class="row ">
                <div class="col-md-3 "></div>
                <div class="col-md-6 ">
                  <div class="form-group text-center">
                    {!!Form::label('Cedula','Cedula:')!!}
                    {!!Form::text('Cedula_Cliente',null,['id'=>'Cedu','class'=>'form-control','placeholder'=>'xxx-xxxxxx-xxxxx', 'onkeypress="return cedulanica(event,this);"','onkeyup="formatonica(this); buscar(this);"'])!!}
                  </div>
                </div>
              </div>
              <div class="row ">
                <div class="col-md">
                  <div class="form-group">
                      {!!Form::label('Nombre:')!!}
                      {!!Form::text('Nombre_Contacto',null,['id'=>'Nom','class'=>'form-control','placeholder'=>'Nombre completo'])!!}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                      {!!Form::label('Direccion:')!!}
                      {!!Form::text('Direccion_Local',null,['id'=>'Dir','class'=>'form-control','placeholder'=>'Direccion del personal'])!!}
                  </div>
                </div>
              </div> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      {!!Form::label('Fecha de Inicio:')!!}
                      <input id="datepicker" width="276" name="Fecha_Inicio"/> 
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      {!!Form::label('Fecha de Fin:')!!}
                      <input id="datepicker2" width="276" name="Fecha_Fin" /> 
                  </div>
                </div>
              </div>
              

            </div>

          </div>



          <script>
          $('#datepicker').datepicker({
              format: 'yyyy-mm-dd',
              uiLibrary: 'bootstrap4',
              iconsLibrary: 'fontawesome',
          });
          $('#datepicker2').datepicker({
              format: 'yyyy-mm-dd',
              uiLibrary: 'bootstrap4',
              iconsLibrary: 'fontawesome',
          });
          $('#Calen').click(function(){
            /*alert('focus');*/ 
              $('#Cal').focus();
          });
          /*Estaba quitando el calendario cuando diera  click en algun lugar q no sea el mismo(pendiente*/
          $('#Cal').blur(function(){
            /*alert('entro');*/
            return;
          });
          </script>  


            <!--TENGO QUE AGREGAR LO QUE EL USUARIO APARTO PARA ESE DIA-->





          <div class="row" >
            <div class="col-md-4">
              <div class="list-group" id="list-tab" role="tablist" style="height:20em; overflow:scroll;">
                @foreach($servicios as $servicio)
                  <a class="list-group-item list-group-item-action" id='{!!$servicio->ID_Servicio!!}' data-toggle="list" href='#{!!$servicio->Nombre!!}' role="tab" aria-controls="{!!$servicio->Nombre!!}">{!!$servicio->Nombre!!}</a>
                @endforeach
              </div>
            </div>
            <!--/*PERFECCIONAR LA TABLA ESPECIFICAR UN ALTO ESTATICO PARA CADA DIRECCION Y UN SCROLL EN "Y"*/-->
            <div class="col-md-8" style="height:20em; overflow:scroll; ">
              <div class="tab-content" id="nav-tabContent">
                @foreach($servicios as $servicio)
                  <div  data-spy="scroll" class="scrollspy-example tab-pane fade"data-target="#list-tab" data-offset="0" id="{!!$servicio->Nombre!!}" role="tabpanel" aria-labelledby="{!!$servicio->ID_Servicio!!}">
                    <table class="table table-hover" id="datos" >
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Cantidad</th>
                          <th>Costo Alquiler</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($inventario as $item)
                          @if($item->ID_Servicio===$servicio->ID_Servicio)
                            <tr>
                              <td>{!!$item->Nombre!!}</td>
                              <td>{!!$item->Cantidad!!}</td>
                              <td>{!!$item->Costo_Alquiler!!}</td>
                              <td>
                                <button  value="{!!$item->ID_Objeto!!}" type="button" class="btn btn-primary reser" data-toggle="modal" data-target="#Add" OnClick='Mostrar(this);'>Reservar</button>
                              </td>
                            </tr>
                          @endif
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <!--Tabla de articulos reservados-->
          <input type="hidden" id="contf" value=0>
          <table class="table table-hover" id="TablaA">
            <thead>
              <tr id="fila0" value="0">
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Costo Alquiler</th>
                <th>Costo Total</th>
              </tr>
            </thead>
            <tbody id="articuloren">
            </tbody>
          </table>
          <button type="button" class="btn btn-primary btn-lg btn-block"OnClick='Enviar();'>Reservar</button> 
        </div> 

        <!--Segunda parte (Pre visualizacion de los datos finales)-->
        <div id="parte2" class="carousel-item">
          <div class="card">
            <h4 class="card-header">Reservar</h4>
            <div class="card-body">
              <button type="button" class="btn btn-primary float-right" OnClick='CambioPag();'>Regresar</button>
              <button type="submit" class="btn btn-primary float-right mr-2" Onclick='Imprimir("imprimir");'>Imprimir</button> 
              <div class="row ">
                <div class="col-md">
                  <div class="form-group">
                      {!!Form::label('DD','',['id'=>'lf','class' => 'badge badge-pill badge-info'])!!}
                  </div>
                </div>
              </div>

              <div class="row ">
                <div class="col-md-6 ">
                  <div class="form-group">
                      {!!Form::label('','Cliente:')!!}
                      {!!Form::label('','Nombre:',['id'=>'lnom','class' => 'badge badge-pill badge-info'])!!}
                      {!!Form::label('','/')!!}
                      {!!Form::label('','Cedula:',['id'=>'lce','class' => 'badge badge-pill badge-info'])!!}
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                      {!!Form::label('','Direccion: ')!!}
                      {!!Form::label('','',['id'=>'ldir','class' => 'badge badge-pill badge-info'])!!}
                  </div>
                </div>
              </div> 

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      {!!Form::label('','Fecha de Inicio: ')!!}
                      {!!Form::label('','',['id'=>'lfi','class' => 'badge badge-pill badge-info'])!!}
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      {!!Form::label('','Fecha de Fin: ')!!}
                      {!!Form::label('','Fecha de Fin:',['id'=>'lff','class' => 'badge badge-pill badge-info'])!!}
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <table class="table table-hover" id="tablaB" name="TB">
                      <thead>
                        <tr id="fila0" value="0">
                          <th>Nombre</th>
                          <th>Cantidad</th>
                          <th>Costo Alquiler</th>
                          <th>Costo Total</th>
                        </tr>
                      </thead>
                      <tbody id="artifin">
                      </tbody>
                    </table>   
                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Ingresar Reserva" Onclick='Imprimir("guarda");' > 
                  </div>
                </div>
              </div> 
              <input type="hidden" id="arre" name="puto" value=" ">
              <input type="hidden" id="ac" name="accion" value=" ">
              
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Modal -->
  <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Cuanto desea reservar?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
          <input type="hidden" id="id">
          <div class="row ">
            <div class="col-md-2">
                {!!Form::label('Cantidad:')!!}
            </div>
            <div class="col-md">
                {!!Form::text('Cantidad',null,['id'=>'cant','class'=>'form-control','autocomplete'=>'off'])!!}
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!!link_to('#TablaA',$title='Añadir',$attributes=['id'=>'anadir','class'=>'btn btn-primary'],$secure = null)!!}
        </div>
      </div>
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
              autocompletar(cedula.value);
          }
      });
      if(autocompletado==false)
      {
        $("#Nom").val("");
      }
  }
  function autocompletar(cedula)
  {
    var ruta="http://127.0.0.1:8080/cliente/"+cedula;
    $.get(ruta, function(res){
          $("#Nom").val(res.Nombre+ " " +res.Apellido);
      });
  }
  </script>
@stop
@section('script')
  {!!Html::script("js/js/articuloadd.js")!!}
  {!!Html::script("js/jskevin/cedulanica.js")!!} 
@endsection