<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfil;
use App\Models\Instituicao;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Validates\DefaultValidator;
use Illuminate\Validation\ValidationException;
use App\Models\Curso;

class EditProfile extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $perfil = Perfil::all();
        $instituicoes = Instituicao::all();
        $instituicao = $user->instituicao;
        $perfis = Perfil::all();
        $cursos = Curso::all();

        if($instituicao == ""){
            $instituicao = $user->instituicao__()->first()->nome;
        }

        return view('auth.edit', compact('user', 'instituicoes', 'instituicao', 'perfis', 'cursos'));
    }

    public function update(Request $request){
        $user = Auth::user();

        

        try {
            DefaultValidator::validate($request->all(), User::$edit_rules, User::$messages);

            if($user->email != $request->email){
                DefaultValidator::validate($request->all(), User::$email_rules, User::$messages);
            }

            if($user->cpf != $request->cpf){
                DefaultValidator::validate($request->all(), User::$cpf_rules, User::$messages);
            }

            if($request->password_confirmation != null){
                DefaultValidator::validate($request->all(), User::$password_rules, User::$messages);
            }

        } catch (ValidationException $exception) {
            return redirect(route('perfil.edit'))
                ->withErrors($exception->validator)->withInput();
        }


        if($request->password_confirmation != null){
            $user->password = Hash::make($request->password);
        }

        $user->name    = $request->name;
        $user->cpf     = $request->cpf;
        $user->email   = $request->email;
        $user->celular = $request->celular;

        $perfil_id = $request->perfil_id;


        if ($perfil_id == '0') {
            $perfil_id = '2';
        }

        $perfil = Perfil::find($request->perfil_id);
        $user->perfil()->associate($perfil);

        if ($perfil_id == '2') { 
            $user->siape = $request->siape;
            $user->json_cursos_ids = json_encode($request->cursos_ids);
            $user->save();

    
        } elseif ($perfil_id == '4') { 
            $user->siape = null;
            $user->json_cursos_ids = json_encode($request->cursos_ids);
            $user->save();
    
            
        }

        return redirect(Route('home'))->with(['mensagem' => 'Dados atualizados com sucesso']);
    }
}
