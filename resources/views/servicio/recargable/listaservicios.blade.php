            @foreach($servicios as $servicio)
                <tr>
                    <td class="text-center">{{$servicio->Nombre}}</td> 
                    {!!Form::open(['route'=>['servicio.destroy',$servicio->ID_Servicio],'method'=>'DELETE'])!!}
                        <td class="text-center">
                            {!!link_to_route('servicio.edit', $title = 'Editar', $parameters = $servicio->ID_Servicio, $attributes = ['class'=>'btn btn-primary'])!!}
                            {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
                        </td>
                    {!!Form::close()!!}
                </tr>
            @endforeach