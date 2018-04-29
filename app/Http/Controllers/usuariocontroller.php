<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alquiler\User;
use Alquiler\Http\Requests;
use Alquiler\Http\Requests\usuarioAdd;
use Alquiler\Http\Requests\usuarioupdate;
use Session;
use Redirect;
use Illuminate\Support\Facades\Hash;

class usuariocontroller extends Controller
{
    public function index()
    {
        $usuarios=user::paginate(10);
        return view('usuario.index',compact('usuarios'));
    }
    public function create()
    {
        return view('usuario.create',['message'=>""]);
    }
    public function store(usuarioAdd $request)
    {
        if($request->get('contraseña')==$request->get('confcontraseña'))
        {
            User::create([
                'name'=>$request['Usuario'],    
                'identificacion'=> $request['identificacion'],
                'password'=>Hash::make($request['contraseña']),//encriptamos la contraseña
                'email'=>($request['correo']),
            ]);
            //$decrypted = decrypt($encryptedValue); ejemplo para desencripta 
            Session::flash('message','Usuario agregado correctamente');
            Session::flash('tipo','info');
            return Redirect::to('/usuario/create');
        }
        else
        {
            Session::flash('message','Hay un problema con su contraseña');
            Session::flash('tipo','danger');
            return view('usuario.create');
        }
    }
    public function edit($name)
    {
        $usuario=user::where('name','=',$name)->get();
        return view('usuario.edit',['usuario'=>$usuario]);
    }
    public function update($id,usuarioupdate $request)
    {
        $usuario=user::where('id','=',$id)->get();//retornamos el registro de esta forma por la utilizacion del dato en edit *MEJORAR*
        if($usuario[0]['email']!=$request->get('correo'))//Si el correo original es diferente al recibido significa aun cambio de correo
        {
            $consulta=user::where('email','=',$request->get('correo'))->get();//consultamos si ya existe
            if(count($consulta)>0)
            {
                Session::flash('message','El correo ya existe');
                Session::flash('tipo','danger');
                return view('usuario.edit',['usuario'=>$usuario]);
            }
            else//si no existe el correo bien puede ser actualizado
            {
                $usuario[0]['email']=$request->get('correo');
            }
        }
        if($usuario[0]['name']!=$request->get('Usuario'))
        {
            $consulta=user::where('name','=',$request->get('Usuario'))->get();
            if(count($consulta)>0)
            {
                Session::flash('message','El usuario ya existe');
                Session::flash('tipo','danger');
                return view('usuario.edit',['usuario'=>$usuario]);
            }
            else
            {
                $usuario[0]['name']=$request->get('Usuario');
            }
        }
        if($request->get('restablecerpass')=="1")
        {
            if($request->get('contraseña')==$request->get('confcontraseña'))
            {
                if(strlen($request->get('contraseña'))>=6)
                    $usuario[0]['password']=Hash::make($request->get('contraseña'));
                else
                {
                    Session::flash('message','La contraseña debe ser mayor o igual a 6 caracteres');
                    Session::flash('tipo','danger');
                    return view('usuario.edit',['usuario'=>$usuario]);
                }
            }
            else
            {
                Session::flash('message','La contraseña no coincidió con la confirmacion');
                Session::flash('tipo','danger');
                return view('usuario.edit',['usuario'=>$usuario]);
            }
        }
        $usuario[0]['identificacion']=$request->get('identificacion');
        $usuario[0]->save();
        Session::flash('message','Usuario editado correctamente');
        Session::flash('tipo','info');
        return Redirect::to('/usuario');
        
        /*$usuario->email=$request->get('correo');
        $usuario->name=$request->get('Usuario');
        $usuario->identificacion=$request->get('identificacion');
        */
        //return $request."aaaaa".$usuario;
        //return $request->all();
        //$usuario->fill($request->all());
        //$usuario->save();
    }
    public function destroy($id)
    {
        $usuario=user::find($id);
        $usuario->delete();
        Session::flash('message','Usuario eliminado correctamente');
        return Redirect::to('/usuario');
    }
    public function existe($parameter,$decision)
    {
        if($decision=="1")
        {
            $usuario=user::where('name','=',$parameter)->get();
            if($usuario!=null)
            {
                return response()->json(
                    $usuario->toArray()
                );
            }
        }
        if($decision=="2")
        {
            $usuario=user::where('email','=',$parameter)->get();
            if($usuario!=null)
            {
                return response()->json(
                    $usuario->toArray()
                );
            }
        }
    }
    public function lista($tipof=null,$valor=null)
    {
        if($tipof=="fus" && $valor!="no")
        {
            $usuarios=user::where('name','like',$valor.'%')->get();
            return view('usuario.recargable.listausuarios',compact('usuarios'));
        }
        if($tipof=="fco" && $valor!="no")
        {
            $usuarios=user::where('email','like',$valor.'%')->get();
            return view('usuario.recargable.listausuarios',compact('usuarios'));
        }
        if($tipof=="fi" && $valor!="no")
        {
            $usuarios=user::where('identificacion','like',$valor.'%')->get();
            return view('usuario.recargable.listausuarios',compact('usuarios'));
        }
        $usuarios=user::all();
        return view('usuario.recargable.listausuarios',compact('usuarios'));
    }
}
