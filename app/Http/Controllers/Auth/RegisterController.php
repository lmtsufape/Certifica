<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Instituicao;
use App\Models\Perfil;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'cpf'       => ['required', 'unique:users'],
            'perfil_id'       => ['required'],
            'instituicao_id'       => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if($data['perfil_id'] == '0')
        {
            $data['perfil_id'] = '2';
        }

        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'perfil_id' => $data['perfil_id'],
            'cpf'       => $data['cpf'],
            'celular' => $data['celular'],
            'instituicao' => $data['instituicao'],
            'siape' => $data['siape'],
            'instituicao_id' => $data['instituicao_id'],
            'json_cursos_ids' => json_encode($data['cursos_ids']),
            
        ]);
    }

    public function showRegistrationForm()
    {
        $perfis = Perfil::all()->where('id', '!=', '1')->where('id', '!=', '3')->sortBy('id');
        $instituicoes = Instituicao::all()->sortBy('id');
        $cursos = Curso::all()->sortBy('id');

        return view('auth.register', compact('perfis', 'instituicoes', 'cursos'));
    }

}
