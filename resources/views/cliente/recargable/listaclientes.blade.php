
  @foreach($clientes as $cliente)
    <tr>
      <td class="text-center">{{$cliente->Cedula_Cliente}}</td> 
      <td>{{$cliente->Nombre}}</td>    
      <td>{{$cliente->Apellido}}</td>  
      <td>{{$cliente->Edad}}</td>  
      <td>{{$cliente->Sexo}}</td>  
          {!!Form::open(['route'=>['cliente.destroy',$cliente->Cedula_Cliente],'method'=>'DELETE'])!!}
            <td>
              {!!link_to_route('cliente.edit', $title = 'Editar', $parameters = $cliente->Cedula_Cliente, $attributes = ['class'=>'btn btn-primary'])!!}
              {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
            </td>
          
          {!!Form::close()!!}
      </tr>
    @endforeach
    