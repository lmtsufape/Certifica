<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\UnidadeAdministrativa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Validates\DefaultValidator;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->perfil_id == 3) {
            $usuarios = User::where('perfil_id', '!=', 1)->where('perfil_id', '!=', 3)->get()->sortBy('id');
        } else {
            $usuarios = User::all()->sortBy('id');
        }

        return view('usuario.usuario_index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check() && Auth::user()->perfil_id == 1)
        {
            $perfils = Perfil::all()->where('id', '!=', 1)->sortBy('id');
        } else{
            $perfils = Perfil::all()->where('id', '!=', 1)->where('id', '!=', 3)->sortBy('id');
        }


        $unidade_administrativas = UnidadeAdministrativa::all()->sortBy('id');

        return view('usuario.usuario_create', ['perfils' => $perfils, 'unidade_administrativas' => $unidade_administrativas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUsuarioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DefaultValidator::validate($request->all(), User::$rules, User::$messages);
        } catch (ValidationException $exception) {
            return redirect(route('usuario.create'))
                ->withErrors($exception->validator)->withInput();
        }


        $usuario = new User();

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->perfil_id = $request->perfil_id;
        $usuario->instituicao_id = 2;

        if($request->perfil_id == 3){
            $usuario->unidade_administrativa_id = $request->unidade_administrativa_id;
            
        } else {
            $usuario->cpf = $request->cpf;
            $usuario->celular = $request->telefone;

        }


        $usuario->save();

        return redirect(Route('usuario.index'))->with(['mensagem' => 'Usuário cadastrado !']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($usuario_id)
    {
        $usuario = User::findOrFail($usuario_id);

        $perfil = Perfil::findOrFail($usuario->perfil_id);


        if($usuario->perfil_id == 2 || $usuario->perfil_id == 4) {
            $perfils = Perfil::where('nome', '!=', 'Gestor Institucional')->where('nome', '!=', 'Administrador')->get();

            return view('usuario.usuario_edit', compact('usuario', 'perfil', 'perfils'));
        } else if($usuario->perfil_id == 1) {
            $perfils = Perfil::where('nome', '!=', 'Gestor Institucional')->where('nome', '!=', 'Administrador')->get();

            return view('usuario.usuario_edit', compact('usuario', 'perfil', 'perfils'));
        } else if($usuario->perfil_id == 3) {
            $perfils = Perfil::where('nome', 'Administrador')->get();

            $unidade_administrativa = UnidadeAdministrativa::findOrFail($usuario->unidade_administrativa_id);
            
            $unidade_administrativas = UnidadeAdministrativa::all()->sortBy('id');

            return view('usuario.usuario_edit', compact('usuario', 'perfil', 'perfils', 'unidade_administrativa', 'unidade_administrativas'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsuarioRequest  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $usuario = User::findOrFail($request->id);

        if($usuario->perfil_id == 2 || $usuario->perfil_id == 4) {
            $usuario->name = $request->name;
            $usuario->cpf = $request->cpf;
            $usuario->email = $request->email;
            $usuario->perfil_id = $request->perfil_id;
        } else if($usuario->perfil_id == 1) {
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->perfil_id = $request->perfil_id;
        } else {
            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->perfil_id = $request->perfil_id;
            $usuario->unidade_administrativa_id = $request->unidade_administrativa_id;
        }
        

        $usuario->update();

        return redirect(Route('usuario.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function delete($usuario_id)
    {
        $usuario = User::findOrFail($usuario_id);
        $usuario->delete();

        return redirect(Route('usuario.index'));
    }

    public function home_administrador()
    {
        return view('administrador.administrador_index');
    }
    public function home_gestor()
    {
        return view('gestor_institucional.gestor_index');
    }
}
