<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use App\personal;

class CargosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        
    }
    public function create()
    {
            $Cargos=Cargo::all();
            $personal=personal::all();
            return view("cargo.create", compact('Cargos','personal'));
    }
}
