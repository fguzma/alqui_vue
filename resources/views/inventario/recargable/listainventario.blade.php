                @foreach($inventario as $item)
                    <tr>
                        <?php
                            $item->ID_Servicio=substr($item->ID_Servicio,2);
                        ?>
                        <td>{{$item->ID_Servicio}}</td> 
                        <td >{{$item->Nombre}}</td>    
                        <td>{{$item->Cantidad}}</td>  
                        <td>{{$item->Estado}}</td>  
                        <td>{{$item->Costo_Alquiler}}</td>  
                        <td>{{$item->Costo_Objeto}}</td>  
                        <td>{{$item->Disponibilidad}}</td>
                        <td>
                            {!!link_to_route('inventario.edit', $title = 'Editar', $parameters = $item->ID_Objeto, $attributes = ['class'=>'btn btn-primary'])!!}
                        </td>
                        <td>
                            {!!Form::open(['route'=>['inventario.destroy',$item->ID_Objeto],'method'=>'DELETE'])!!}
                            {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
                            {!!Form::close()!!}
                        </td>
                    </tr>
                @endforeach

