<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alquiler\Http\Requests;
use Alquiler\reservacion;
use Alquiler\descripcion;
use Alquiler\servicio;
use Alquiler\Inventario;
use Alquiler\desre;
use Alquiler\Http\Requests\AddReserva;
use Redirect;
use PDF;

class ReservacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        /*Retorna todos los datos de la tabla reservacion e inventario de la BD a index*/
        $servicios=Servicio::all();
        $inventario=Inventario::all();
        return view('reservacion.index',compact('servicios','inventario'));
    }
    public function store(AddReserva $request)
    { 
        $Arreglo=[""];
        $cadena=$request['puto'];
        $pos=0;
        //recorre un arreglo que contiene los items reservados con sus respectiva informacion+el gran total
        for ($i=0; $i <strlen($cadena); $i++) { 
            if(strcmp($cadena[$i],',')===0)
            {
                $pos++;
                array_push($Arreglo,"");
            }
            else
            {
            $Arreglo[$pos]=$Arreglo[$pos].$cadena[$i];
            }
        }
        /*Si envie el parametro guardar, lo guarda*/
        if(strcmp($request['accion'],"guarda")==0)
        {
            //Agregamos a la tabla reservacion
            reservacion::create([
            'Cedula_Cliente'=>$request['Cedula_Cliente'],    
            'Nombre_Contacto'=> $request['Nombre_Contacto'],
            'Direccion_Local'=>($request['Direccion_Local']),
            'Fecha_Inicio'=>$request['Fecha_Inicio'],
            'Fecha_Fin'=>$request['Fecha_Fin'],
            ]);
            $reservacion=reservacion::all();
            $reservacion=$reservacion->last();
            $pos=0;
            //Hacemos un recorrido en el arreglo que posee toda la descripcion de la factura para poder agregar cada unda de las descripciones
            for($i=0;$i<(count($Arreglo)-4)/4;$i++)//restamos 4 porque hay 4 elementos de mas y dividimos entre la cantidad de columnas para q nos de la cantidad de fila
            {
                descripcion::create([
                'Cantidad'=> $Arreglo[$pos+1],
                'Nombre'=>$Arreglo[$pos],
                'P_Unitario'=>$Arreglo[$pos+2],
                'Total'=>$Arreglo[$pos+3],
                ]);
                    
                $des=descripcion::all();
                $des=$des->last();
                $pos+=4;
                desre::create([
                    'idReservacion'=>$reservacion["ID_Reservacion"],
                    'idDescripcion'=>$des['IdDescripcion'],
                ]);
            }
            return redirect('/reservacion')->with('message',"Se agrego la reservacion correctamente");//view('personal.create',['message'=>"Se agrego al usuario exitosamente"]);
        }
        else
        {/*
            return $Arreglo;*/
            $CC=$request['Cedula_Cliente'];
            $NC= $request['Nombre_Contacto'];
            $DL=($request['Direccion_Local']);
            $FI=$request['Fecha_Inicio'];
            $FF=$request['Fecha_Fin'];
            
        /* return  $request['artifin'];
            $view =  \View::make('Reservacion.pdf', compact('CC', 'NC', 'DL','FI', 'FF'))->render();*/
            //$pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML($view);
            $pdf=PDF::loadView('Reservacion.fac', compact('CC', 'NC', 'DL','FI', 'FF','Arreglo'));
            return $pdf->stream('invoice.pdf');
        }
    }
    public function listing()
    {
        $servicios=inventario::all();
        return response()->json(
            $servicios->toArray()
        );
    }
    public function edit($id)
    {
        $servicios=inventario::find($id);
        return response()->json(
            $servicios->toArray()
        );
    }
    public function show($cad)
    {
        $servicios=inventario::find($id)->where('Nombre',$cad+'%');
        return response()->json(
            $servicios->toArray()
        );
    }
}
