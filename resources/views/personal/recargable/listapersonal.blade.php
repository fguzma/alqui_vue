                @foreach($personal as $trabajador)
                    <tr>
                        <td>{{$trabajador->Cedula_Personal}}</td> 
                        <td>{{$trabajador->Nombre}}</td>    
                        <td>{{$trabajador->Apellido}}</td>  
                        <td>{{$trabajador->Direccion}}</td>  
                        <td>{{$trabajador->Fecha_Nac}}</td>  
                        {!!Form::open(['route'=>['personal.destroy',$trabajador->Cedula_Personal],'method'=>'DELETE'])!!}
                            <td>
                                {!!link_to_route('personal.edit', $title = 'Editar', $parameters = $trabajador->Cedula_Personal, $attributes = ['class'=>'btn btn-primary'])!!}
                                {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
                            </td>
                        {!!Form::close()!!}
                    </tr>
                @endforeach