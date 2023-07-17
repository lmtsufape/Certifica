<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificado extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'certificados';
    protected $fillable = ['atividade_id', 'certificado_modelo_id',
     'assinatura_esquerda', 'img_fundo', 'texto', 'logo'];


    public function atividade(){
        return $this->belongsTo(Atividade::class);
    }

    public static function search_acao($certificados, $nome_acao){
        $acoes = Acao::where('titulo', 'ilike', '%'.$nome_acao.'%')->get();
        return $certificados->whereIn('atividade.acao', $acoes);
    }

    public static function search_natureza($certificados, $natureza){
        $naturezas = Natureza::where('id', $natureza)->get();
        return $certificados->whereIn('atividade.acao.tipo_natureza.natureza', $naturezas);
    }
}
