<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TipoNatureza extends Model
{
    use HasFactory;
    protected $table = 'tipo_naturezas';

    protected $fillable = [
        'descricao',
        'natureza_id',
    ];

    public static $rules = [
        'descricao' => 'required|string|unique:tipo_naturezas',
        'natureza_id' => 'required',
    ];

    public static $messages = [
        'descricao.required' => 'A descrição é obrigatória',
        'descricao.unique' =>   'Já existe um Tipo de Natureza cadastrado com esta descrição',
        'natureza_id' => 'O tipo da natureza é obrigatório',
    ];

    public function naturezas(){
        return $this->belongsTo('App\Models\Natureza');
    }
}
