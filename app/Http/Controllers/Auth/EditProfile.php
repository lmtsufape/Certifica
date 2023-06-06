<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfil;
use App\Models\Instituicao;

class EditProfile extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $perfil = Perfil::all();
        $instituicoes = Instituicao::all();
        $instituicao = $user->instituicao;

        if($instituicao == ""){
            $instituicao = $user->instituicao__()->first()->nome;
        }

        return view('auth.edit', compact('user', 'instituicoes', 'instituicao'));
    }

    public function update(Request $request){
        dd($request->all());
    }
}
