            <thead>
                <th class="text-center">Correo</th>
                <th class="text-center">Usuario</th>
                <th class="text-center">Identificacion</th>
            </thead>
            <tbody class="text-center" id="lista"> 
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->email}}</td> 
                        <td>{{$usuario->name}}</td>    
                        <td>{{$usuario->identificacion}}</td>  
                        {!!Form::open(['route'=>['usuario.destroy',$usuario->id],'method'=>'DELETE'])!!}
                            <td>
                                {!!link_to_route('usuario.edit', $title = 'Editar', $parameters = $usuario->name, $attributes = ['class'=>'btn btn-primary'])!!}
                                {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
                            </td>
                        {!!Form::close()!!}
                    </tr>
                @endforeach
            </tbody>
                