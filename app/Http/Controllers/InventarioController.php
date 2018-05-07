<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alquiler\Http\Requests;
use Alquiler\Http\Requests\ArticuloAdd;
use Alquiler\Http\Requests\PersonalUpdate;
use Alquiler\Inventario;
use Alquiler\Servicio;
use Redirect;
use Session;
use DB;
class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    { 
        $inventario=Inventario::paginate(10);
        $servicios=servicio::all();
        return view('inventario.index',compact('inventario','servicios'));
    }
    public function store(ArticuloAdd $request)
    { 
            Inventario::create([
            'ID_Servicio'=>$request['ID_Servicio'],    
            'Nombre'=> $request['Nombre'],    
            'Estado'=> "Bueno",
            'Cantidad'=>$request['Cantidad'],
            'Costo_Alquiler'=>($request['Costo_Alquiler']),
            'Costo_Objeto'=> $request['Costo_Objeto'],
            'Disponibilidad'=> $request['options'],
        ]);

        $servicios=Servicio::all();
        Session::flash('message','Articulo Agregado correctamente');
        Session::flash('tipo','info');
        return response()->json(
                ['exito' => 'bien']
            );
        //return view('inventario.create',['message'=>"Se agrego al usuario exitosamente",'servicios'=>$servicios]);
    }

    public function destroy($id)
    {
        $articulo=Inventario::find($id);
        $articulo->delete();
        Session::flash('message','Articulo eliminado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/inventario');
    }
    public function edit($id)
    {
         $articulo=Inventario::find($id);//DB::table('cliente')->where('Cedula_Cliente','=',$Cedula_Cliente)->get()
         //dd($cliente->get(0));
         //dd($cliente);
         //return $cliente->Nombre;
         $servicios=Servicio::all();
         return view('inventario.edit',['articulo'=>$articulo,'servicios'=>$servicios]);
       // return Redirect::to('/editar');
    }
    public function update($id,ArticuloAdd $request)
    {
        $articulo=Inventario::find($id);
        $articulo->fill($request->all());
        $articulo->save();
        Session::flash('message','Articulo editado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/inventario');
    }
    public function create()
    {
        $servicios=Servicio::all();
        return view('inventario.create',['message'=>"",'servicios'=>$servicios]);
    }
    public function lista($idservicio=null,$nombreArt=null)
    {
        if($idservicio!="0" && $nombreArt=="0")
            $inventario=inventario::where('ID_Servicio','=','ID'.$idservicio)->get();
        if($idservicio=="0" && $nombreArt!="0")
            $inventario=inventario::where('Nombre','like',$nombreArt.'%')->get();
        if($idservicio!="0" && $nombreArt!="0")
           $inventario=inventario::where('Nombre','like',$nombreArt.'%')->where('ID_Servicio','=','ID'.$idservicio)->get();
        if($idservicio=="0" && $nombreArt=="0")
           $inventario=inventario::all();
        
        return view('inventario.recargable.listainventario',compact('inventario'));
    }

    public function mensaje($val=null)
    {
        if($val=="msj")
            return view('alert.mensaje');
        else
            return view('inventario.errores');
            
    }
}