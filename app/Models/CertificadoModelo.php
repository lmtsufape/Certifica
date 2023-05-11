<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CertificadoModelo extends Model
{
    use HasFactory;

    protected $table = 'certificado_modelos';

    protected $fillable = ['descricao',
     'imagem', 'texto', 'unidade_administrativa_id'];

    public static $rules = [
        'descricao'                     => 'required',
        'fundo'                        => 'required | image',
        'texto'                         => 'required',
        'unidade_administrativa_id'     => 'required',
    ];

    public static $edit_rules = [
        'descricao'                     => 'required',
        'texto'                         => 'required',
    ];

    public static $messages = [
        'descricao.required'              => 'A descrição é obrigatória',
        'fundo.required'                 => 'A imagem de fundo é obrigatória',
        'fundo.image'                    => 'A imagem de fundo deve ser um arquivo do tipo imagem',
        'texto.*'                         => 'O texto padrão é obrigatório',
    ];


    public function unidadeAdministrativa(){
        return $this->belongsTo(UnidadeAdministrativa::class, 'unidade_administrativa_id');
    }
}
