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
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::callback('global', function ($query, $value) {
                    $query->where(function ($query) use ($value) {
                        $query->where('name', 'ILIKE', "%{$value}%")
                            ->orWhere('cpf', 'ILIKE', "%{$value}%")
                            ->orWhere('email', 'ILIKE', "%{$value}%");
                    });
                })
            ])
            ->sortable();

        if (Auth::user()->perfil_id == 3) {
            $query->whereNotIn('perfil_id', [1, 3])
                  ->where('is_service_account', false);
        }

        $usuarios = $query->paginate(20)->appends(request()->query());

        return view('usuario.usuario_index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->perfil_id == 1) {
            $perfils = Perfil::all()->where('id', '!=', 1)->sortBy('id');
        } else {
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
        if ($request->tipo_conta == 'normal') {
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

            if ($request->perfil_id == 3) {
                $usuario->unidade_administrativa_id = $request->unidade_administrativa_id;
            } else {

                if ($request->cpf) {
                    $usuario->cpf = $request->cpf;
                }

                if ($request->passaporte) {
                    $usuario->passaporte = $request->passaporte;
                }

                $usuario->celular = $request->telefone;
            }


            $usuario->save();

            return redirect(Route('usuario.index'))->with(['mensagem' => 'Usuário cadastrado !']);
        } else {
            try {
                DefaultValidator::validate($request->all(), User::$service_rules, User::$messages);
            } catch (ValidationException $exception) {
                return redirect(route('usuario.create'))
                    ->withErrors($exception->validator)->withInput();
            }

            $usuario = new User();

            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make(\Illuminate\Support\Str::random(20)); // Senha aleatoria
            $usuario->perfil_id = 5; // Sistema
            $usuario->instituicao_id = 1; // UFAPE
            $usuario->is_service_account = true;
            $usuario->unidade_administrativa_id = $request->unidade_administrativa_id;
            $usuario->save();

            return redirect(Route('usuario.index'))->with(['mensagem' => 'Usuário cadastrado !']);
        }
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


        if ($usuario->perfil_id == 2 || $usuario->perfil_id == 4) {
            $perfils = Perfil::where('nome', '!=', 'Gestor Institucional')->where('nome', '!=', 'Administrador')->get();

            return view('usuario.usuario_edit', compact('usuario', 'perfil', 'perfils'));
        } else if ($usuario->perfil_id == 1) {
            $perfils = Perfil::where('nome', '!=', 'Gestor Institucional')->where('nome', '!=', 'Administrador')->get();

            return view('usuario.usuario_edit', compact('usuario', 'perfil', 'perfils'));
        } else if ($usuario->perfil_id == 3) {
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

        if ($usuario->perfil_id == 2 || $usuario->perfil_id == 4) {
            $usuario->name = $request->name;
            $usuario->cpf = $request->cpf;
            $usuario->passaporte = $request->passaporte;
            $usuario->email = $request->email;
            $usuario->perfil_id = $request->perfil_id;
        } else if ($usuario->perfil_id == 1) {
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

    public function finalizar_cadastro(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if ($request->perfil_id == 'professor') {
            $perfil = 2;

            $user->celular = $request->celular;
            $user->perfil_id = $perfil;
            $user->siape = $request->siape;
            $user->json_cursos_ids = json_encode($request->cursos_ids);
            $user->password = Hash::make($request->password);
            $user->cadastro_finalizado = true;
        } else if ($request->perfil_id == 'tecnico') {
            $perfil = 2;

            $user->celular = $request->celular;
            $user->perfil_id = $perfil;
            $user->siape = $request->siape;
            $user->password = Hash::make($request->password);
            $user->cadastro_finalizado = true;
        } else if ($request->perfil_id == 'estudante') {
            $perfil = 4;

            $user->celular = $request->celular;
            $user->perfil_id = $perfil;
            $user->json_cursos_ids = json_encode($request->cursos_ids);
            $user->password = Hash::make($request->password);
            $user->cadastro_finalizado = true;
        }


        $user->update();

        return redirect(route('home'))->with(['mensagem' => 'Cadastro Finalizado com Sucesso!']);
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
