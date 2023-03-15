<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TipoNatureza extends Model
{
    use HasFactory;
    protected $table = 'tipo_naturezas';

    protected $fillable = ['descricao'];

    public static $rules = [
        'descricao' => 'required|string|unique:tipo_naturezas',
    ];

    public static $messages = [
        'descricao.required' => 'A descrição é obrigatória',
        'descricao.unique' =>   'Já existe um Tipo de Natureza cadastrado com esta descrição',
    ];

    public function naturezas(){
        return $this->hasMany('App\Models\Natureza');
    }
}
