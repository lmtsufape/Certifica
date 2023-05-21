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
        'unidade_administrativa_id'
    ];

    public static $rules = [
        'descricao' => 'required|string|min:5',
    ];

    public static $mensages = [
        'descricao' => 'A descrição é obrigatória e deve ter no mínimo 5 caracteres',
    ];

    public function tipoNatureza(){
        return $this->hasMany('App\Models\TipoNatureza');
    }
}
