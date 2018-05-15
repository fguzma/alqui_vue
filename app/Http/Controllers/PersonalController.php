<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\PersonalAdd;
use App\Http\Requests\PersonalUpdate;
use App\personal;
use Redirect;
use Session;
use DB;

class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $personal=Personal::paginate(10);
        $valor="";
        return view('personal.index',compact('personal','valor'));
    }
    public function store(PersonalAdd $request)
    { 
            Personal::create([
            'Cedula_Personal'=>$request['Cedula_Personal'],    
            'Nombre'=> $request['Nombre'],
            'Apellido'=>$request['Apellido'],
            'Direccion'=>($request['Direccion']),
            'Fecha_Nac'=> $request['Fecha_Nac'],
        ]);

        Session::flash('message','Personal agregado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/verpersonal'.'/'.$cedula);
    }

    public function destroy($id)
    {
        $usuario=personal::find($id);
        $usuario->delete();
        Session::flash('message','Personal eliminado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/personal');
    }
    public function edit($Cedula_Cliente)
    {
         $trabajador=personal::find($Cedula_Cliente);//DB::table('cliente')->where('Cedula_Cliente','=',$Cedula_Cliente)->get()
         //dd($cliente->get(0));
         //dd($cliente);
         //return $cliente->Nombre;
         return view('personal.edit',['trabajador'=>$trabajador]);
       // return Redirect::to('/editar');
    }
    public function update($cedula,PersonalUpdate $request)
    {
        $usuario=personal::find($cedula);
        $usuario->fill($request->all());
        $usuario->save();
        Session::flash('message','Personal editado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/verpersonal'.'/'.$cedula);
    }
    public function create()
    {
        return view('personal.create',['message'=>""]);
    }
    public function show($cedula)
    {
        $personal=personal::find($cedula);
        if($personal!=null)
        {
            return response()->json(
                $personal->toArray()
            );
        }
    }
    public function lista($value=null)
    {
        $personal=personal::where('Cedula_Personal','like',$value.'%')->paginate(10);
        return view('personal.recargable.listapersonal',compact('personal'));
    }
            
    public function agregado($valor=null)
    {
        $personal=personal::paginate(10);
        return view('personal.index',compact('personal','valor'));
    }
}
