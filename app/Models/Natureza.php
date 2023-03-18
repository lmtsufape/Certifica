<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Natureza extends Model
{
    use HasFactory;


    protected $table = 'naturezas';

    protected $fillable = [
        'descricao',
        'tipo_natureza_id',
        'unidade_administrativa_id'
    ];

    public static $rules = [
        'descricao' => 'required|string|min:10',
        'tipo_natureza_id' => 'required',
        'unidade_administrativa_id' => 'required',
    ];

    public static $mensages = [
        'descricao' => 'A descrição é obrigatória e deve ter no mínimo 10 caracteres',
        'tipo_natureza_id' => 'O tipo da natureza é obrigatório',
        'unidade_administrativa_id' => 'Unidade Adiministrativa é obricatória',
    ];

    public function tipoNatureza(){
        return $this->belongsTo('App\Models\TipoNatureza');
    }
}
