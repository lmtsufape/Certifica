<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'perfil_id',
        'cpf',
        'passaporte',
        'celular',
        'instituicao',
        'instituicao_id',
        'siape',
        'instituicao_id',
        'json_cursos_ids',
        'cadastro_finalizado',
    ];

    public static $rules = [
        'name'              => 'required | string | max:255',
        'email'             => 'required | string | email | max:255 |unique:users',
        'password'          => 'required | string | min:8 | confirmed',
        'perfil_id'         => 'required',
    ];


    public static $edit_rules = [
        'name'              => 'required | string | max:255',
        'email'             => 'required | string | email | max:255',
    ];

    public static $password_rules = [
        'password'          => 'required | string | min:8 | confirmed',
    ];

    public static $email_rules = [
        'email'             => 'required | string | email | max:255 |unique:users',
    ];

    public static $cpf_rules = [
        'cpf'               => 'unique:users',
    ];

    public static $messages = [
        'name.required'       => 'O nome deve ser preenchido',
        'name.string'         => 'O nome deve possuir apenas letras',
        'name.max'            => 'O nome deve ter menos de 255 caracteres',
        'email.required'      => 'O email deve ser preenchido',
        'email.string'        => 'O email deve possuir apenas letras',
        'email.email'         => 'E-mail inválido',
        'email.max'           => 'O email deve possuir no máximo 255 caracteres',
        'email.unique'        => 'O email informado já está cadastrado no sistema',
        'password.min'        => 'A senha deve possuir 8 ou mais caracteres',
        'password.confirmed'  => 'As senhas devem ser iguais',
        'cpf.unique'          => 'O CPF informado já está cadastrado',
        'passaporte.unique'   => 'O passaporte informado já está cadastrado'

    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function instituicao__(){
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    public function perfil(){
        return $this->belongsTo(Perfil::class);
    }

    public function participacoes(){
        return $this->hasMany(Participante::class);
    }

    public function acoes(){
        return $this->hasMany(Acao::class, 'usuario_id');
    }
    public function colaboracoes(){
        return $this->hasMany(Colaborador::class, 'user_id');
    }

    public function firstName(){
        try {
            $split_name = preg_split("/[\s,]+/",$this->name,);

            $name = $split_name[0];

        } catch (\Throwable $th) {
            $name = $this->name;
        }

        return $name;

    }





}
