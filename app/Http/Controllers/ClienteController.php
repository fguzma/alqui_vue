<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alquiler\Http\Controllers\Controller;
use Alquiler\Http\Requests;
use Alquiler\Http\Requests\clienteAdd;
use Alquiler\Http\Requests\clienteUpdate;
use Alquiler\Cliente;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Redirect;
use Session;
use DB;
class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        
        $clientes=Cliente::paginate(10);
        $valor="";
        return view('cliente.index',compact('clientes','valor'));
    }
    public function store(clienteAdd $request)
    { 
            Cliente::create([
            'Cedula_Cliente'=>$request['Cedula_Cliente'],    
            'Nombre'=> $request['Nombre'],
            'Apellido'=>$request['Apellido'],
            'Edad'=>($request['Edad']),
            'Sexo'=> $request['Sexo'],
        ]);
        //Fucionalidad con JS (retorno un msj para hacer uso de la funcion successfull)
        /* return response()->json([
            "mensaje"=>"Agregado exitosamente"
        ]);*/
        
        //Session::flash('message','Cliente agregado correctamente');
        //return Redirect::to('/users');
        return redirect('/vercliente'.'/'.$request['Cedula_Cliente']);
    }

    public function destroy($id)
    {
        $usuario=cliente::find($id);
        $usuario->delete();
        Session::flash('message','Cliente eliminado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/cliente');
    }
    public function edit($Cedula_Cliente)
    {
         $cliente=Cliente::find($Cedula_Cliente);//DB::table('cliente')->where('Cedula_Cliente','=',$Cedula_Cliente)->get()
         //dd($cliente->get(0));
         //dd($cliente);
         //return $cliente->Nombre;
         return view('cliente.edit',['cliente'=>$cliente]);
       // return Redirect::to('/editar');
    }
    public function update($cedula,clienteUpdate $request)
    {
        $usuario=cliente::find($cedula);
        $usuario->fill($request->all());
        $usuario->save();
        Session::flash('message','Cliente editado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/vercliente'.'/'.$cedula);
    }
    public function create()
    {
        return view('cliente.create',['message'=>""]);
    }
    public function show($id)
    {
        $cliente=cliente::find($id);
        if($cliente!=null)
        {
            return response()->json(
                $cliente->toArray()
            );
        }
    }
    public function lista($value=null)
    {
        $clientes=cliente::where('Cedula_Cliente','like',$value.'%')->paginate(10);
        return view('cliente.recargable.listaclientes',compact('clientes'));
    }
    public function prueba()
    {
        return view('cliente.create',['message'=>""]);
    }
            
    public function agregado($valor=null)
    {
        $clientes=Cliente::paginate(10);
        return view('cliente.index',compact('clientes','valor'));
    }
}
