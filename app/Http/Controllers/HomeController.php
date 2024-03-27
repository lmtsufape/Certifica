<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acao;
use App\Models\Curso;
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
        if(Auth::user()->cadastro_finalizado === false || Auth::user()->cadastro_finalizado === null && Auth::user()->perfil_id === 2 || Auth::user()->perfil_id === 4)
        {
            $cursos = Curso::all()->sortBy('id');

            return view('usuario.finalizar_cadastro', compact('cursos'))->with(['mensagem' => 'Finalize seu cadastro para ter acesso ao sistema']);
        }

        if(Auth::user()->perfil_id == 1){

            return view('administrador.index'); //admin

        } else if(Auth::user()->perfil_id == 2){

            $acaos = Acao::where('usuario_id', Auth::user()->id)->get();

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

            return view('coordenador.index',compact('aprovadas','analise','devolvidas')); //cordenador

        } else if (Auth::user()->perfil_id == 3){

            return view('gestor_institucional.index'); //gestor
        } else if (Auth::user()->perfil_id == 4) {
            return view('participante.index');
        }

        return view('auth.login');
    }
}
