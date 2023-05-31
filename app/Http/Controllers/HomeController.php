<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acao;
use Illuminate\Support\Facades\Auth;

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

            $acaos = Acao::all();

            $aprovadas = 0;
            $analise = 0;
            $devolvidas = 0;

            foreach ($acaos as $acao) {
                if ($acao->status == "Aprovada") {
                    $aprovadas++;
                }
                if ($acao->status == "Em análise") {
                    $analise++;
                }
                if ($acao->status == "Reprovada") {
                    $devolvidas++;
                }
            }

            return view('coordenador.index',[ 'aprovadas' => $aprovadas ,'analise' => $analise, 'devolvidas' => $devolvidas ]); //cordenador
        } else if (Auth::user()->perfil_id == 3){
            return view('gestor_institucional.index'); //gestor
        }

        return view('auth.login');
    }

    public function sistema() {
        //return view('home.sistema');
        return "o sistema";
    }

    public function contato(){
        return 'Contato VIEW';
    }

}
