<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->perfil_id == 1){
            return view('administrador.index'); //admin

        } else if(Auth::user()->perfil_id == 2){
            return view('coordenador.index'); //cordenador

        } else if (Auth::user()->perfil_id == 3){
            return view('gestor_institucional.index'); //gestor
        }
    }
}
