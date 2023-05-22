<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';

    protected $fillable = [
        'titulo',
        'carga_horaria',
        'atividade_id',
        'user_id'
    ];

    public static $rules = [
        'nome' => 'required|min:10',
        'email' => 'required|email',
        'instituicao_id' => 'required',
        'instituicao' => 'required_if:instituicao_id,2',
        'cpf' => 'required|regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
        'titulo' => 'required',
        'carga_horaria' => 'required|numeric',
        'atividade_id' => 'required',
    ];

    public static $editRules = [
        'titulo' => 'required',
        'carga_horaria' => 'required|numeric',
        'atividade_id' => 'required',
    ];

    public static $messages = [
        'nome.*' => 'O nome do participante é obrigatório e deve ter no mínimo 10 caractéres',
        'email.*' => 'O e-mail é obrigatório e deve ser um endereço de e-mail válido',
        'cpf.regex' => 'O CPF é obrigatório e deve ser um número de CPF válido',
        'titulo' => 'O título é obrigatório',
        'carga_horaria.required' => 'A carga horária é obrigatória',
        'carga_horaria.numeric' => 'A carga horária deve ser um numero',
        'instituicao.*' => 'Ao selecionar Outras no campo instituição, é preciso informar a sua instituição'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
